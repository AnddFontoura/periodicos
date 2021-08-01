<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Category;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    protected function validation(Request $request): void
    {
        $this->validate($request, [
            'name' => 'required|max:254',
            'authors' => 'required',
            'resume' => 'required',
            'abstract' => 'required',
            'keywords' => 'required',
            'fileToUpload' => 'required|max:15000',
        ]);
    }

    public function index()
    {
        $articles = Articles::paginate(20);

        return view('admin.article.index', compact('articles'));
    }

    public function list(Request $request)
    {
        $articles = Articles::paginate(20);

        return view('admin.article.index', compact('articles'));
    }

    public function create(int $id = null)
    {
        $article = null;
        $subCategories = SubCategory::orderBy('name', 'asc')->get();

        if ($id) {
            $article = Articles::where('id', $id)->first();
        }

        return view('admin.article.form', compact('article', 'subCategories'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $request = $request->all();

        $categories = Category::orderBy('name', 'asc')->get();

        $article = Articles::create([
            'subcategory_id' => $request['subCategoryId'],
            'name' => $request['name'],
            'authors' => $request['authors'],
            'resume' => $request['resume'],
            'abstract' => $request['abstract'],
            'keywords' => $request['keywords'],
        ]);

        if ($request['fileToUpload']) {
            $fileName = $article->id . Str::slug($article->name) . Carbon::now()->timestamp;
            Storage::disk('articles')->put($fileName, $request['fileToUpload']);

            $article->path = $fileName;
            $article->save();
        }

        return view('admin.article.form', compact('article','categories'));
    }

    public function show(int $id)
    {
        $article = Articles::where('id', $id)
            ->first();

        return view('admin.category.view', compact('article'));
    }

    public function update(Request $request, int $id)
    {
        $request = $request->all();

        $checkIfNameIsBeingUsedInAnotherArticle = Articles::where('name', $request['name'])
            ->where('id', '<>', $id)
            ->first();

        if (empty($checkIfNameIsBeingUsedInAnotherArticle)) {
            $article = Category::where('id', $request['id'])
                ->update([
                    'category_id' => $request['categoryId'],
                    'name' => $request['name'],
                    'authors' => $request['authors'],
                    'resume' => $request['resume'],
                    'abstract' => $request['abstract'],
                    'keywords' => $request['keywords'],
                ]);
        } else {
            return back()->withErrors(['name' => 'Name already being used in another article']);
        }

        return back();
    }
}
