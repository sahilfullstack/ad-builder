<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
	public $timestamps = false;

    /**
     * The attributes that can be filled by the developer.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];
    
}
