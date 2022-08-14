<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\File;

class CategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('viewAny', $this->category);
            $category =  Category::create($request->except('image', '_token'));
            if ($request->hasFile('image') && $request->image != '') {
                $image_path = $category->image;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $category->update(['image' => uploadImage('dashboard/img/categories/', $request->image)]);
            }
            return CategoryResource::make($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $categoryadmin)
    {
        
        $this->authorize('viewAny', $this->category);
        $id = $categoryadmin->id;
        $categoryadmin->update($request->except('image', '_token'));
        if ($request->hasFile('image') && $request->image != '') {
            $image_path = $categoryadmin->image;  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $categoryadmin->update(['image' => uploadImage('dashboard/img/categories/', $request->image)]);
        }
        $category = Category::find($id);
        return CategoryResource::make($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categoryadmin)
    {
        Category::where('id', $categoryadmin->id)->delete();
        return response()->json(['message' => 'yor data delete success'], 200);
    }
}
