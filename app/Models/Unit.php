<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'name', 'template_id', 'components', 'user_id', 'type', 'parent_id'
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
}
