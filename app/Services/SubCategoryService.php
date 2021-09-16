<?php

namespace App\Services;

use App\SubCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SubCategoryService
{
    public static function filterSubCategory(Request $request): Builder
    {
        $categoryId = $request->get('categoryId');
        $subCategoryId = $request->get('subCategoryId');
        $subCategoryName = $request->get('subCategoryName');

        $subcategories = SubCategory::query();

        if ($categoryId) {
            $subcategories = $subcategories->where('category_id', '=', $categoryId);
        }

        if ($subCategoryId) {
            $subcategories = $subcategories->where('id', '=', $subCategoryId);
        }

        if ($subCategoryName) {
            $subcategories = $subcategories->where('name', 'like', "%" . $subCategoryName . "%");
        }

        return $subcategories;
    }

    public static function getSubCategoryForSelect(): SubCategory
    {
        return SubCategory::orderBy('name', 'asc')
            ->get();
    }
}
