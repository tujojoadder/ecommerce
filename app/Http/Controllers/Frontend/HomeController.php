<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::where('is_deleted', 0)->get();
        $products = Product::all();
        $banners=Banner::all();
        return view('frontend.index', compact('sliders', 'categories','products','banners'));
    }
}