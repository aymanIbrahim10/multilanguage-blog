<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
         $categories = Category::paginate(15);
        return  CategoryResource::collection($categories);
    }
    public function navbarCategory()
    {
        $categories = Category::with('children')->where('parent', 0)->orWhere('parent', null)->get();
        // return CategoryResource::collection($categories);
        return new CategoryCollection($categories);
    }

    public function indexpagecategorywithpost()
    {
        $categories_with_posts = Category::with(['posts'=>function ($q){
            $q->with('user')->with('category')->limit(3);
        }])->get();
        return  new CategoryCollection($categories_with_posts);
    }
    public function show($id)
    {
        $category =  Category::where('id',$id)->firstOrfail();
        return CategoryResource::make($category);

    }
}
