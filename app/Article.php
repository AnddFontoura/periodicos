<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subcategory_id',
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

    public function subcategory()
    {
        return $this->hasOne(SubCategory::class,'id', 'subcategory_id');
    }
}
