<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $table = "sub_categories";
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [

    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];
}
