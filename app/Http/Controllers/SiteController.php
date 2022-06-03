<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Page;
use App\SubCategory;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $pageForMenu;

    private $categoryForMenu;

    function __construct()
    {
       $this->pageForMenu = Page::all();
       $this->categoryForMenu = Category::orderBy('name', 'desc')->get();
    }

    public function index(?int $pageId = null)
    {
        $pageForMenu = $this->pageForMenu;
        $categoryForMenu = $this->categoryForMenu;

        if($pageId) {
            $page = Page::where('id', $pageId)->first();
        } else {
            $page = Page::where('home_page', true)->first();
        }

        return view('site.home', compact('page', 'pageForMenu', 'categoryForMenu'));
    }

    public function subCategoryList(int $categoryId)
    {
        $pageForMenu = $this->pageForMenu;
        $categoryForMenu = $this->categoryForMenu;

        $subCategories = SubCategory::where('category_id', $categoryId)->paginate(20);
        $category = Category::where('id', $categoryId)->first();

        return view('site.subcategoriesList', compact('subCategories', 'category', 'pageForMenu', 'categoryForMenu'));
    }

    public function articleList(int $subCategoryId)
    {
        $pageForMenu = $this->pageForMenu;
        $categoryForMenu = $this->categoryForMenu;

        $subCategory = SubCategory::where('id', $subCategoryId)->first();
        $articles = Article::where('subcategory_id', $subCategoryId)->paginate(20);

        return view('site.articlesList', compact('subCategory', 'articles', 'pageForMenu', 'categoryForMenu'));
    }

    public function articleView(int $articleId)
    {
        $pageForMenu = $this->pageForMenu;
        $categoryForMenu = $this->categoryForMenu;

        $article = Article::where('id', $articleId)->first();

        return view('site.articlesView', compact('article', 'pageForMenu', 'categoryForMenu'));
    }
}
