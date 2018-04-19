<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Unit extends Model
{
    use Loggable, SoftDeletes;

    const SOFT_DELETION_TOKEN = 'deleted_at_millis';

    /**
     * The attributes that can be filled by the developer.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'template_id', 'components', 'user_id', 'type', 'parent_id', 'layout_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'components' => 'array'
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
                'name' => 'Ad Name',
                'slug' => 'basic',
                'order' => 4
            ],
            [
                'name' => 'Build Landing Page',
                'slug' => 'page',
                'order' => 5
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

    public function child()
    {
        return $this->hasOne(Unit::class, 'parent_id');
    }

    public function getTypeHumanAttribute()
    {
        return $this->types[$this->type];
    }

    public function getStateAttribute()
    {
        if(! is_null($this->approved_at)) return 'Approved';
        
        if(! is_null($this->rejected_at)) return 'Rejected';
        
        if(! is_null($this->published_at)) return 'Published (awaiting approval)';

        return 'Draft';
    }

    public function nextSectionEditRoute($currentSectionSlug)
    {
        $nextSection = unit_next_section($this->type, $currentSectionSlug);

        if(is_null($nextSection)) return route('units.list', ['type', $this->type]);

        return route('units.edit', ['unit' => $this, 'section' => $nextSection['slug']]);
    }
}
