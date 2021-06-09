<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function validation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:subcategory',
        ]);
    }

    public function index(Request $request)
    {
        $subcategory = SubCategory::get();

        return view('admin.subcategory.index', compact('subcategory'));
    }

   public function create(?int $id = null)
    {
        $subcategory = null;

        if ($id) {
            $subcategory = SubCategory::where('id',$id)->first();
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
            'image' => $request['image']
        ]);

        return back();
    }

    public function show($id)
    {
        $subcategory = SubCategory::where('id', $id)->first();

        return view('admin.subcategory.show', compact($subcategory));
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

    public function destroy($id)
    {
        $subcategory = Subcategory::where('id', $id)->delete();

        return back();
    }
}
