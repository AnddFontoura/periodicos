<?php

namespace App\Http\Controllers;

use App\Category;
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

        $category = Category::create([
            'subcategory_id' => $request->post('subCategoryId'),
            'name' => $request->post('name'),
            'image' => $request->post('image'),
            'description' => $request->post('description')
        ]);

        return back();
    }

    /**
     * @param int $id
     */
    public function show(int $id)
    {
        $category = Category::where('id', $id)->first();

        return view('category.show', compact('category'));
    }

    public function update(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

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
