<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
