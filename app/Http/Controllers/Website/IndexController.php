<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories_with_posts = Category::with(['posts'=>function ($q){
            $q->limit(3);
        }])->get();
       return view('frontend.home' , compact('categories_with_posts'));
    }
}
