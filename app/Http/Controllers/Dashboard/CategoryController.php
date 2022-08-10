<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\URL;
class CategoryController extends Controller
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
        return view('dashboard.categories.index');
    }
    public function getCategoriesDatatable(){
        
        $data = Category::select('*')->with('getParent');
        return   Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (auth()->user()->can('viewAny', $this->category)) {
                    return $btn = '
                        <a href="' . Route('categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                }
            })
            ->addColumn('image', function ($row) { 
                $url=asset("$row->image"); 
                $imageUrl = URL::to('dashboard/img/default/default.png');
                if(!$row->image){
                    
return '<img src='.$imageUrl.' border="0" width="40" class="img-rounded" align="center" />';
                }else{
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 

                }
         })
            
            ->addColumn('parent', function ($row) {
                return ($row->parent ==  0) ? trans('words.main category') :   $row->getParent->translate(app()->getLocale())->title;
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-y');
            })

            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
            ->rawColumns(['action','title','image'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny', $this->category);
        $categories = Category::whereNull('parent')->orWhere('parent', 0)->get();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('viewAny', $this->category);
        try {
            $category =  Category::create($request->except('image', '_token'));
            if ($request->hasFile('image') && $request->image != '') {
                $image_path = $category->image;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $category->update(['image' => uploadImage('dashboard/img/categories/', $request->image)]);
            }
            return redirect()->route('categories.index')->with(['success' => __('words.add successfuly')]);    
        } catch (\Throwable $th) {
            return redirect()->route('categories.index')->with(['error' => __('words.there are something wrong please try again later')]);    

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
    public function edit(Category $category)
    {
        $this->authorize('viewAny', $this->category);

        $categories = Category::whereNull('parent')->orWhere('parent', 0)->get();
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('viewAny', $this->category);
        try {
        $category->update($request->except('image', '_token'));
        if ($request->hasFile('image') && $request->image != '') {
            $image_path = $category->image;  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $category->update(['image' => uploadImage('dashboard/img/categories/', $request->image)]);
        }
        return redirect()->route('categories.index')->with(['success' => __('words.edit successfuly')]);
    } catch (\Throwable $th) {
        return redirect()->route('categories.index')->with(['error' => __('words.there are something wrong please try again later')]);    

    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $this->authorize('viewAny', $this->category);

        if (is_numeric($request->id)) {
            Category::where('parent', $request->id)->delete();
            Category::where('id', $request->id)->delete();
        }
        return redirect()->route('categories.index')->with(['success' => __('words.delete successfuly')]);

    }
}
