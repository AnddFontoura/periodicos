<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function validation(Request $request)
    {
        $this->validate($request, [
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
        $category = Category::get();

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

        $category = Category::create([
            'name' => $request['name'],
            'image' => $request['image'] ?? null,
            'description' => $request['description']
        ]);

        return view('admin.category.form', compact('category'));
    }

    public function view($id)
    {
        $category = Category::where('id', $id)
            ->first();

        $countSubCategory = SubCategory::where('category_id', $category->id)
            ->count('id');

        $countArticle = Article::join('sub_categories','sub_categories.id', '=', 'articles.subcategory_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where('categories.id', $category->id)
            ->count('articles.id');

        return view('admin.category.view', compact('category', 'countSubCategory', 'countArticle'));
    }

    public function update(Request $request, int $id)
    {
        $request = $request->all();

        $checkIfNameIsBeingUsedInAnotherCategory = Category::where('name', $request['name'])
            ->where('id', '<>', $id)
            ->first();

        if (empty($checkIfNameIsBeingUsedInAnotherCategory)) {
            $category = Category::where('id', $id)
                ->update([
                    'name' => $request['name'],
                    'description' => $request['description']
                ]);
        } else {
            return back()->withErrors(['name' =>  'Name already being used in another category']);
        }

        return back();
    }
}
