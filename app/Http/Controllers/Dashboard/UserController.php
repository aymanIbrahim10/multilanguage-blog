<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        
        return view('dashboard.users.index');
        // if (auth()->user()->can('viewAny', $this->user)) {
        // $data = User::select('*');
        // }else{
        //     $data = User::where('id' , auth()->user()->id);
        // }
        
    }

    public function getUsersDatatable(){
        if (auth()->user()->can('viewAny', $this->user)) {
            $data = User::select('*');
            }else{
                $data = User::where('id' , auth()->user()->id);
            }
        return   Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                if (auth()->user()->can('update', $row)) {
                    $btn .= '<a href="' . Route('users.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';
                }
                if (auth()->user()->can('delete', $row)) {
                    $btn .= '
                        
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->addColumn('avatar', function ($row) { 
                $url=asset("$row->avatar"); 
                $imageUrl = URL::to('dashboard/img/avatars/default.png');
                if(!$row->avatar){
                    
return '<img src='.$imageUrl.' border="0" width="40" class="img-rounded" align="center" />';
                }else{
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 

                }
         })
         ->addColumn('created_at', function ($row) {
            return $row->created_at->format('d-m-y');
        })
            ->addColumn('status', function ($row) {
                return $row->status == null ? __('words.not activated') : __('words.' . $row->status);
            })
            ->rawColumns(['action','status','avatar'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->user);
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('update', $this->user);
        try {
            //code...
        
        $user = User::create([
            'name' => $request->name,
            'status' => $request->status,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if ($request->hasFile('avatar') && $request->avatar != '') {
            $image_path = $user->avatar;  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $user->update(['avatar' => uploadImage('dashboard/img/avatars/', $request->avatar)]);
        }
        return redirect()->route('users.index')->with(['success' => __('words.add successfuly')]);

    } catch (\Throwable $th) {
        
        return redirect()->route('users.index')->with(['error' => __('words.there are something wrong please try again later')]);

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
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('dashboard.users.edit', compact('user'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        try {
            $user->update($request->except('avatar', '_token'));
        if ($request->hasFile('avatar') && $request->avatar != '') {
            $image_path = $user->avatar;  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $user->update(['avatar' => uploadImage('dashboard/img/categories/', $request->avatar)]);
        }
        return redirect()->route('users.index')->with(['success' => __('words.edit successfuly')]);
    } catch (\Throwable $th) {
        return redirect()->route('users.index')->with(['error' => __('words.there are something wrong please try again later')]);

    }

    }
public function passView(User $user){
    return view('dashboard.users.password', compact('user'));
}
public function passwordChange(Request $request, User $user){
    $this->validate($request, [

        'oldpassword' => 'required',
        'newpassword' => 'required|min:8',
        'password_confirmation'=>'required|same:newpassword'
        ]);
    $hashedPassword = Auth::user()->password;
    if (\Hash::check($request->oldpassword , $hashedPassword )) {
      if (!\Hash::check($request->newpassword , $hashedPassword)) {
           $users =User::find(Auth::user()->id);
           $users->password = bcrypt($request->newpassword);
           User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
           return redirect()->route('users.index')->with(['success' => __('words.password updated successfully')]);
         }
         else{
             return redirect()->back()->with(['error' => __('words.new password can not be the old password !')]);
        }
     }
       else{
         return redirect()->back()->with(['error' => __('words.old password doesnt matchedr')]);
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

    public function delete(Request $request){
        $this->authorize('delete', $this->user);
         
        if(is_numeric($request->id)){
            User::where('id', $request->id)->delete();
        }
        return redirect()->route('users.index')->with(['success' => __('words.edit successfuly')]);
    }
}
