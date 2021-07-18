<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'path',
        'authors',
        'resume',
        'abstract',
        'keywords',
        'image',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
