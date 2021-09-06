<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function validation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:pages'
        ]);
    }

    public function list(Request $request)
    {
        $pages = Page::paginate(20);

        return view('admin.page.index', compact('pages'));
    }

    public function index(Request $request)
    {
        $pages = Page::get();

        return view('page.index', compact('pages'));
    }

    public function create(?int $id = null)
    {
        $page = null;

        if ($id) {
            $page = Page::where('id', $id)->first();
        }

        return view('admin.page.form', compact('page'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

        $page = Page::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        return view('admin.page.form', compact('page'));
    }

    public function view($id)
    {
        $page = Page::where('id', $id)
            ->first();

        return view('admin.page.view', compact('page'));
    }

    public function update(Request $request, int $id)
    {
        $request = $request->all();

        $checkIfNameIsBeingUsedInAnotherPage = Page::where('name', $request['name'])
            ->where('id', '<>', $id)
            ->first();

        if (empty($checkIfNameIsBeingUsedInAnotherPage)) {
            $page = Page::where('id', $id)
                ->update([
                    'name' => $request['name'],
                    'description' => $request['description']
                ]);
        } else {
            return back()->withErrors(['name' =>  'Name already being used in another page']);
        }

        return back();
    }
}
