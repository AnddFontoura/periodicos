<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
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

    public function index()
    {
        $pageForMenu = $this->pageForMenu;
        $categoryForMenu = $this->categoryForMenu;

        $homePage = Page::where('home_page', true)->first();

        return view('site.home', compact('homePage', 'pageForMenu', 'categoryForMenu'));
    }
}
