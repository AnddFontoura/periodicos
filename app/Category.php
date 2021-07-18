<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subcategory_id',
        'name',
        'description',
        'image',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function subCategory() {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
