<?php

namespace App\Services;

use App\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArticlesService
{
    public static function filterArticles(Request $request): Builder
    {
        $subCategoryId = $request->get('subCategoryId');
        $name = $request->get('articleName');
        $authors = $request->get('articleAuthors');
        $resume = $request->get('articleResume');
        $abstract = $request->get('articleAbstract');
        $keywords = $request->get('articleKeywords');
        $articleId = $request->get('articleId');

        $articles = Article::query();

        if ($articleId) {
            $articles = $articles->where('id', '=', $articleId);
        }

        if ($subCategoryId) {
            $articles = $articles->where('sub_category_id', '=', $subCategoryId);
        }

        if ($name) {
            $articles = $articles->where('name', 'like', '%' . $name . '%');
        }

        if ($authors) {
            $articles = $articles->where('authors', 'like', '%' . $authors . '%');
        }

        if ($resume) {
            $articles = $articles->where('resume', 'like', '%' . $resume . '%');
        }

        if ($abstract) {
            $articles = $articles->where('abstract', 'like', '%' . $abstract . '%');
        }

        if ($keywords) {
            $articles = $articles->where('keywords', 'like', '%' . $keywords . '%');
        }

        return $articles;
    }
}
