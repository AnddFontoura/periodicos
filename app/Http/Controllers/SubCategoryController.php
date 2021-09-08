<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function validation(Request $request)
    {
        $this->validate($request, [
            'categoryId' => 'required',
            'name' => 'required|unique:sub_categories',
        ]);
    }

    public function list(Request $request)
    {
        $categories = Category::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

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

        $subcategories = $subcategories->paginate(20);

        return view('admin.subcategory.index', compact('subcategories', 'categories'));
    }

    public function index(Request $request)
    {
        $subcategory = SubCategory::get();

        return view('admin.subcategory.index', compact('subcategory'));
    }

   public function create(int $id = null)
    {
        $subcategory = null;

        $categories = Category::all();

        if ($id) {
            $subcategory = SubCategory::where('id', $id)->first();
        }

        return view('admin.subcategory.form', compact('subcategory', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

        $categories = Category::all();

        $subcategory = SubCategory::create([
            'category_id' => $request['categoryId'],
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $request['image'] ?? null
        ]);

        return view('admin.subcategory.form', compact('subcategory', 'categories'));
    }

    public function view($id)
    {
        $subCategory = SubCategory::where('id', $id)
            ->first();

        $countCategory = SubCategory::where('category_id', $subCategory->category_id)
            ->count('id');

        $countArticle = Article::join('sub_categories','sub_categories.id', '=', 'articles.subcategory_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where('sub_categories.id', $subCategory->id)
            ->count('articles.id');

        return view('admin.subcategory.view', compact('subCategory', 'countCategory', 'countArticle'));
    }

    public function update(Request $request, int $id)
    {
        $request = $request->all();

        $checkIfNameIsBeingUsedInAnotherSubCategory = SubCategory::where('name', $request['name'])
            ->where('id', '<>', $id)
            ->first();

        if (empty($checkIfNameIsBeingUsedInAnotherSubCategory)) {
            $subcategory = Subcategory::where('id', $id)
                ->update([
                    'categoryId' => $request['categoryId'],
                    'name' => $request['name'],
                    'description' => $request['description']
                ]);
        } else {
            return back()->withErrors(['name' => 'Name already being used in another subcategory']);
        }

        return back();
    }
}
