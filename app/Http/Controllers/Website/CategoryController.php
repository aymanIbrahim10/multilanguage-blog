<?php

namespace App\Http\Controllers\Website;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $category = $category->load('children');
        $posts = Post::where('category_id' , $category->id)->paginate(4);
        
        return view('frontend.category' , compact('category','posts'));
    }
}
