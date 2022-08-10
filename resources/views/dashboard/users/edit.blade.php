@extends('layouts.dashboard')
@section('title',__('words.users') . ' | ' . __('words.user edit'))
@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('words.home') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('words.dashboard home') }}</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('words.users') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('words.user edit') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <form action="{{ route('users.update',$user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                @method('PUT')
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('words.edit board') }}</strong>
                            </div>
                            <div class="card-block">


<div class="col-md-12 col-sm-12 col-lg-12">
                                    <img id="file-ip-1-preview" src="@if(!$user->avatar)
                                    {{ asset('dashboard/img/avatars/default.png')}}
                                    @else
                                
                                    {{ asset($user->avatar) }}
                                    @endif" alt="{{ __('words.user avatar') }}"
                                        style="
                                    height: 100px;
                                    width: 100px;
                                    border-radius: 8px;
                                    border: 2px solid #ddd;">
                                    <div class="form-group">
                                        <label for="file-ip-1">{{ __('words.user avatar') }} : </label>
                                        <input type="file" name="avatar" class="form-control" id="file-ip-1"
                                            accept="image/*" onchange="showPreview(event);">
                                        <span class="help-block text-danger text-danger">
                                            @error('avatar')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('words.user name') }} : </label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="{{ __('words.user name') }}"
                                            value="{{$user->name}}">
                                        <span class="help-block text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="email">{{ __('words.user email') }} : </label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="{{ __('words.user email') }}"
                                            value="{{$user->email}}">
                                        <span class="help-block text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                 
                                @can('viewAny' , $user)
                                    
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label>{{ __('words.user type') }}</label>
                                        <select name="status" id="" class="form-control">
                                          
                                            <option value="admin" @if ($user->status == 'admin')
                                                selected
                                            @endif>{{__('words.admin')}}</option>
                                            <option value="writer" @if ($user->status == 'Writer')
                                                selected
                                            @endif>{{__('words.writer')}}</option>
                                        </select>
                                       
                                    </div>
                                </div>

                                @endcan

                            </div>
                            <div class="card-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-md btn-success "><i class="fa fa-dot-circle-o"></i>
                                    {{ __('words.save data') }}</button>
                                <a href="{{ route('users.index') }}" class="btn btn-md btn-danger">
                                        <i class="fa fa-ban"></i>
                                        {{ __('words.go back') }}</a>
                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                </form>
                
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>


@endsection  
