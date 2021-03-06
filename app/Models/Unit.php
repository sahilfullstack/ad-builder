<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Traits\ContainsSoftDeletableUniques;
use Illuminate\Support\Carbon;

class Unit extends Model
{
    use Loggable, SoftDeletes, ContainsSoftDeletableUniques;

    const SOFT_DELETION_TOKEN = 'deleted_at_millis';

    /**
     * The attributes that can be filled by the developer.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'template_id', 'category_id', 'components', 'experimental_components', 'user_id', 'type', 'is_holder', 'parent_id', 'holder_id', 'layout_id', 'redeemed_subscription_id', 'scheduled_at', 'is_popup'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'scheduled_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'components' => 'array',
        'experimental_components' => 'array'
    ];
    
    protected $types = [
        'ad' => 'Ad',
        'page' => 'Landing Page'
    ];

    public static $sections = [
        'ad' => [
            [
                'name' => 'Choose Layout',
                'slug' => 'layout',
                'order' => 1
            ],
            [
                'name' => 'Choose Template',
                'slug' => 'template',
                'order' => 2
            ],
            [
                'name' => 'Customize Ad',
                'slug' => 'components',
                'order' => 3
            ],
            [
                'name' => 'Category',
                'slug' => 'category',
                'order' => 4
            ],
            [
                'name' => 'Ad Name',
                'slug' => 'basic',
                'order' => 5
            ],
            [
                'name' => 'Build Landing Page',
                'slug' => 'page',
                'order' => 6
            ],
        ],
        'page' => [
            [
                'name' => 'Choose Ad',
                'slug' => 'ad',
                'order' => 1
            ],
            [
                'name' => 'Choose Template',
                'slug' => 'template',
                'order' => 2
            ],
            [
                'name' => 'Customize Landing Page',
                'slug' => 'components',
                'order' => 3
            ],
            [
                'name' => 'Landing Page Name',
                'slug' => 'basic',
                'order' => 4
            ],
            [
                'name' => 'Submit for Approval',
                'slug' => 'submit',
                'order' => 5
            ],
        ]

    ];

    /**
     * Limit the search to only not deleted elements.
     *
     * @param $query
     * @return void
     */
    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at')->where(self::SOFT_DELETION_TOKEN, 0);
    }

    public function scopePublished($query)
    {
        return $query->notDeleted()->whereNotNull('published_at');
    }

    public function scopeApproved($query)
    {
        return $query->notDeleted()->whereNotNull('approved_at');
    }

    public function scopeAd($query)
    {
        return $query->where('type', 'ad');
    }

    public function scopeNoHolders($query)
    {
        return $query->where('is_holder', false);
    }

    public function scopeNoHoldees($query)
    {
        return $query->whereNull('holder_id');
    }

    public function scopeUnexpired($query)
    {
        return $query->whereNull('expired_at');
    }

    public function scopeForCurrentUser($query)
    {
        $user = auth()->user();

        // If a user exists without the permission to manage everyone's units. AKA Advertiser.
        if( ! is_null($user) && $user->cannot('unit.manage'))
        {
            $query->where('user_id', $user->id);
        }

        return $query;
    }

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Unit::class);
    }

    public function holdee()
    {
        return $this->hasMany(Unit::class, 'holder_id')->orderBy('id');
    }

    public function child()
    {
        return $this->hasOne(Unit::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function expire()
    {
        $this->expired_at = Carbon::now();
        $this->save();
    }

    public function restore()
    {
        $this->expired_at = null;
        $this->save();
    }

    public function getNameAttribute($value)
    {
        if($this->is_holder)
            return $this->layout->name
                . ' - including '
                . $this->holdee->first()->name 
                . ', and '
                . ($this->holdee->count() - 1)
                . ' others';

        return $value;
    }

    public function getTypeHumanAttribute()
    {
        return $this->types[$this->type];
    }

    public function getStateAttribute()
    {
        if(! is_null($this->expired_at)) return 'Expired';
        
        if(! is_null($this->approved_at)) return 'Approved';
        
        if(! is_null($this->rejected_at)) return 'Rejected';
        
        if(! is_null($this->published_at) and is_null($this->processed_at) ) return 'Processing';

        if(! is_null($this->published_at)) return 'Published (awaiting approval)';

        return 'Draft';
    }

    public function getReadableComponentsAttribute()
    {
        $components = Component::notDeleted()->find(array_keys($this->components));

        $readableComponents = [];
        foreach($this->components as $id => $component)
        {
            $readableComponents[$components->where('id', $id)->first()->slug] = array_merge(['_id' => $id], $component);
        }
        
        return $readableComponents;
    }


    public function getReadableExperimentalComponentsAttribute()
    {
        $components = Component::notDeleted()->find(array_keys($this->experimental_components));
        
        $readableComponents = [];
        foreach($this->experimental_components as $id => $component)
        {
            $readableComponents[$components->where('id', $id)->first()->slug] = array_merge(['_id' => $id], $component);
        }
        
        return $readableComponents;
    }

    public function nextSectionEditRoute($currentSectionSlug)
    {
        $nextSection = unit_next_section($this->type, $currentSectionSlug);

        if(is_null($nextSection)) return route('units.list', ['type', $this->type]);

        return route('units.edit', ['unit' => $this, 'section' => $nextSection['slug']]);
    }
}
