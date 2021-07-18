<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function validation(Request $request)
    {
        $this->validate($request, [
            'subCategoryId' => 'required|int',
            'name' => 'required|unique:categories'
        ]);
    }

    public function list(Request $request)
    {
        $categories = Category::paginate(20);

        return view('admin.category.index', compact('categories'));
    }

    public function index(Request $request)
    {
        $category =  Category::get();

        return view('category.index', compact('category'));
    }

    public function create(?int $id = null)
    {
        $category = null;
        $subCategories = SubCategory::orderBy('name', 'asc')->get();

        if ($id) {
            $category = Category::where('id', $id)->first();
        }

        return view('admin.category.form', compact('category','subCategories'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

        $subCategories = SubCategory::orderBy('name', 'asc')->get();

        $category = Category::create([
            'subcategory_id' => $request['subCategoryId'],
            'name' => $request['name'],
            'image' => $request['image'] ?? null,
            'description' => $request['description']
        ]);

        return view('admin.category.form', compact('category','subCategories'));
    }

    public function view($id)
    {
        $category = Category::where('id', $id)
            ->first();

        $subcategory = SubCategory::where('id', $category->subcategory_id)
            ->first();

        $countCategory = Category::where('subcategory_id', $category->subcategory_id)
            ->count('id');

        $countArticle = Articles::join('categories','categories.id','=','articles.category_id')
            ->where('categories.subcategory_id', $subcategory->id)
            ->count('articles.id');

        return view('admin.category.view', compact('category','subcategory', 'countCategory', 'countArticle'));
    }

    public function update(Request $request, int $id)
    {
        $request = $request->all();

        $checkIfNameIsBeingUsedInAnotherSubCategory = SubCategory::where('name', $request['name'])
            ->where('id', '<>', $id)
            ->first();

        $category = Category::where('id', $request['id'])
            ->update([
                'subcategory_id' => $request['subCategoryId'],
                'name' => $request['name'],
                'image' => $request['image'],
                'description' => $request['description']
            ]);

        return back();
    }
}
