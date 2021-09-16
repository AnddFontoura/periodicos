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
        $name = $request->get('subCategoryId');
        $authors = $request->get('subCategoryId');
        $resume = $request->get('subCategoryId');
        $abstract = $request->get('subCategoryId');
        $keywords = $request->get('subCategoryId');

        $articles = Article::query();

        if ($subCategoryId) {
            $articles = $articles->where('id', '=', $subCategoryId);
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
