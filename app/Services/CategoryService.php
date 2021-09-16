<?php

namespace App\Services;

use App\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryService
{
    public static function filterCategory(Request $request): Builder
    {
        $categoryId = $request->get('categoryId');
        $categoryName = $request->get('categoryName');

        $categories = Category::query();

        if ($categoryId) {
            $categories = $categories->where('id', '=', $categoryId);
        }

        if ($categoryName) {
            $categories = $categories->where('name', 'like', "%" . $categoryName . "%");
        }

        return $categories;
    }
}
