<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class HeaderController extends Controller
{
    public function index()
    {
        $navCategories = Category::where('show_in_nav', 1)->get();
        $otherCategories = Category::where('show_in_nav', 0)->get();

        return view('frontend.header', compact('navCategories', 'otherCategories'));
    }
}
