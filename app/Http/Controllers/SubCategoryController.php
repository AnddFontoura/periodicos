<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function validation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_categories',
        ]);
    }

    public function list(Request $request)
    {
        $subcategories = SubCategory::paginate(20);

        return view('admin.subcategory.index', compact('subcategories'));
    }

    public function index(Request $request)
    {
        $subcategory = SubCategory::get();

        return view('admin.subcategory.index', compact('subcategory'));
    }

   public function create(int $id = null)
    {
        $subcategory = null;

        if ($id) {
            $subcategory = SubCategory::where('id', $id)->first();
        }

        return view('admin.subcategory.form', compact('subcategory'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

        $subcategory = SubCategory::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $request['image'] ?? null
        ]); 
        
        return view('admin.subcategory.form', compact('subcategory'));
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
        
        return view('admin.subcategory.view', compact('subcategory', 'countCategory', 'countArticle'));
    }

    public function update(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

        $subcategory = Subcategory::where('id', $request['id'])
            ->update([
                'name' => $request['name'],
                'description' => $request['description']
            ]);

        return back();
    }

    public function delete($id)
    {
        $subcategory = Subcategory::where('id', $id)->delete();

        return back();
    }
}
