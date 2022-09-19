<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Services\ArticlesService;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    protected function validation(Request $request): void
    {
        $this->validate($request, [
            'subCategoryId' => 'required|int',
            'authors' => 'required',
            'resume' => 'required',
            'abstract' => 'required',
            'keywords' => 'required',
            'fileToUpload' => 'nullable|mimes:pdf',
        ]);
    }

    public function index(Request $request)
    {
        $articles = ArticlesService::filterArticles($request);
        $articles = $articles->paginate(20);

        return view('admin.article.index', compact('articles'));
    }

    public function list(Request $request)
    {

        $articles = ArticlesService::filterArticles($request);
        $articles = $articles->paginate(20);

        return view('admin.article.index', compact('articles'));
    }

    public function create(int $id = null)
    {
        $article = null;
        $subCategories = SubCategory::orderBy('name', 'asc')->get();

        if ($id) {
            $article = Article::where('id', $id)->first();
        }

        return view('admin.article.form', compact('article', 'subCategories'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $subCategories = SubCategory::orderBy('name', 'asc')->get();

        $article = Article::create([
            'subcategory_id' => $request->post('subCategoryId'),
            'name' => $request->post('name'),
            'authors' => $request->post('authors'),
            'resume' => $request->post('resume'),
            'abstract' => $request->post('abstract'),
            'keywords' => $request->post('keywords'),
            'path' => 'unknown'
        ]);

        if ($request->file('fileToUpload')) {
            //$fileName = $article->id . Str::slug($article->name) . Carbon::now()->timestamp;
            $fileName = Storage::disk('articles')->put('', $request['fileToUpload']);

            $article->path = $fileName;
            $article->save();
        }

        return view('admin.article.form', compact('article','subCategories'));
    }

    public function view(int $id)
    {
        $article = Article::where('id', $id)
            ->first();

        $subCategory = SubCategory::where('id', $article->subcategory_id)
            ->first();

        $category = Category::where('id', $subCategory->category_id)
            ->first();

        return view('admin.article.view', compact('article','subCategory', 'category'));
    }

    public function update(Request $request, int $id)
    {
        $request = $request->all();

        $article = Article::where('id', $id)
            ->update([
                'subcategory_id' => $request['subCategoryId'],
                'name' => $request['name'],
                'authors' => $request['authors'],
                'resume' => $request['resume'],
                'abstract' => $request['abstract'],
                'keywords' => $request['keywords'],
            ]);

        $article = Article::where('id', $id)->first();

        if ($request['fileToUpload']) {
            //$fileName = $article->id . Str::slug($article->name) . Carbon::now()->timestamp;
            $fileName = Storage::disk('articles')->put('', $request['fileToUpload']);

            $article->path = $fileName;
            $article->save();
        }
    
        return back();
    }
}
