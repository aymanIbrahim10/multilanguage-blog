<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $postmodel;

    public function __construct(Post $post)
    {
        $this->postmodel = $post;
    }

    public function index()
    {

        return view('dashboard.posts.index');
    }
    public function getPostsDatatable()
    {
        $data = Post::select('*')->with('category');
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (auth()->user()->can('update', $row)) {
                    return $btn = '
                        <a href="' . Route('posts.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                } else {
                    return;
                }
            })

            ->addColumn('category_name', function ($row) {
                return  $row->category->translate(app()->getLocale())->title;
            })
            ->addColumn('image', function ($row) {
                $url = asset("$row->image");
                $imageUrl = URL::to('dashboard/img/default/default.png');
                if (!$row->image) {
                    return '<img src=' . $imageUrl . ' border="0" width="40" class="img-rounded" align="center" />';
                } else {
                    return '<img src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
                }
            })

            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
            ->addColumn('content', function ($row) {
                return $row->translate(app()->getLocale())->content;
            })
            ->addColumn('smallDesc', function ($row) {
                return $row->translate(app()->getLocale())->smallDesc;
            })
            ->addColumn('tags', function ($row) {
                return $row->translate(app()->getLocale())->tags;
            })
            ->rawColumns(['action', 'title', 'category_name', 'content', 'smallDesc', 'tags', 'image'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent' ,'>' , 0)->get();
        if (count($categories) > 0) {
            return view('dashboard.posts.create', compact('categories'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...

            $post =  Post::create($request->except('image', '_token'));
            $post->update(['user_id' => auth()->user()->id]);
            if ($request->hasFile('image') && $request->image != '') {
                $image_path = $post->image;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $post->update(['image' => uploadImage('dashboard/img/posts/', $request->image)]);
            }
            return redirect()->route('posts.index')->with(['success' => __('words.add successfuly')]);
        } catch (\Throwable $th) {
            return $th;
            return redirect()->route('posts.index')->with(['error' => __('words.there are something wrong please try again later')]);
        }
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
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::where('parent' ,'>' , 0)->get();
        if (is_numeric($post->id)) {
            if (count($categories) > 0) {
                return view('dashboard.posts.edit', compact('post', 'categories'));
            }
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        try {
            //code...

            $post->update($request->except('image', '_token'));
            $post->update(['user_id' => auth()->user()->id]);
            if ($request->hasFile('image') && $request->image != '') {
                $image_path = $post->image;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $post->update(['image' => uploadImage('dashboard/img/posts/', $request->image)]);
            }
            return redirect()->route('posts.index')->with(['success' => __('words.edit successfuly')]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('posts.index')->with(['error' => __('words.there are something wrong please try again later')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete(Request $request)
    {
        if (is_numeric($request->id)) {
            Post::where('id', $request->id)->delete();
        }
        return redirect()->route('posts.index')->with(['success' => __('words.delete successfuly')]);
    }
}
