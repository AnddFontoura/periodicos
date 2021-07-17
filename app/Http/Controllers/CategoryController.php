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
            'subcategoryId' => 'required|int',
            'name' => 'required|unique:category'
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

        if ($id) {
            $category = Category::where('id', $id)->first();
        }

        return view('category.form', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

        $category = Category::create([
            'subcategory_id' => $request['subCategoryId'],
            'name' => $request['name'],
            'image' => $request['image'],
            'description' => $request['description']
        ]);

        return view('category.form', compact('category'));
    }

    public function view($id)
    {
        $subcategory = SubCategory::where('id', $id)
            ->first();

        $countCategory = Category::where('subcategory_id', $subcategory->id)
            ->count('id');

        $countArticle = Articles::join('categories','categories.id','=','articles.category_id')
            ->where('categories.subcategory_id', $subcategory->id)
            ->count('articles.id');

        return view('admin.category.view', compact('subcategory', 'countCategory', 'countArticle'));
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

    public function destroy($id)
    {
        $category = Category::where('id', $id)->delete();

        return back();
    }
}
