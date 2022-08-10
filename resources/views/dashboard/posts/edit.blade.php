@extends('layouts.dashboard')
@section('title', __('words.posts') . ' | ' . __('words.post edit'))
@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('words.home') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('words.dashboard home') }}</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('words.posts') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('words.post edit') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('dashboard.alerts.error')
                @include('dashboard.alerts.success')

                <form action="{{ route('posts.update',$post) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('words.add board') }}</strong>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <img id="file-ip-1-preview" src="@if(!$post->image)
                                    {{ asset('dashboard/img/default/default.png')}}
                                    @else
                                
                                    {{ asset($post->image) }}
                                    @endif" alt="{{ __('words.post image') }}"
                                        style="
                                    height: 100px;
                                    width: 100px;
                                    border-radius: 8px;
                                    border: 2px solid #ddd;">
                                    <div class="form-group">
                                        <label for="file-ip-1">{{ __('words.post image') }} : </label>
                                        <input type="file" name="image" class="form-control" id="file-ip-1"
                                            accept="image/*" onchange="showPreview(event);">
                                        <span class="help-block text-danger text-danger">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-12">

                                    <div class="form-group">
                                        <label>{{ __('words.category name') }}</label>
                                        <select name="category_id" id="" class="form-control" required>
                                            @foreach ($categories as $category)
                                                <option  @selected($post->category_id == $category->id) value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block text-danger text-danger">
                                            @error('category_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-block">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach (config('app.avaiable_lang') as $key => $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->index == 0) active @endif"
                                                id="home-tab" data-toggle="tab" href="#{{ $key }}" role="tab"
                                                aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach (config('app.avaiable_lang') as $key => $lang)
                                        <div class="tab-pane fade show @if ($loop->index == 0) active in @endif"
                                            id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                            </br>
                                            <div class="form-group mt-2 col-md-12">
                                                <label> {{ __('words.post name') }} : ( {{ $lang }} ) </label>
                                                <input type="text" class="form-control" name="title:{{ $key }}"
                                                    id="title:{{ $key }}" value="{{$post->translate($key)->title}}"
                                                    placeholder="{{ __('words.post name') }}">
                                                <span class="help-block text-danger">
                                                    @error('title:' . $key)
                                                        {{ __($message) }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="form-group mt-2 col-md-12">
                                                <label>{{ __('words.post content') }}</label>
                                                <textarea name="content:{{ $key }}" class="form-control" id="editor" cols="50" rows="10">{{$post->translate($key)->content}}</textarea>
                                                <span class="help-block text-danger">
                                                    @error('content:' . $key)
                                                        {{ __($message) }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="form-group mt-2 col-md-12">
                                                <label> {{ __('words.post small title') }} : ( {{ $lang }} ) </label>
                                                <textarea name="smallDesc:{{ $key }}" class="form-control" id="editor" cols="50" rows="10">{{$post->translate($key)->smallDesc}}</textarea>
                                                <span class="help-block text-danger">
                                                    @error('smallDesc:' . $key)
                                                        {{ __($message) }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group mt-2 col-md-12">
                                                <label> {{ __('words.post tag') }} : ( {{ $lang }} ) </label>
                                                <input type="text" name="tags:{{ $key }}"
                                                    id="tags:{{ $key }}" class="form-control"
                                                    placeholder="{{ __('words.post tag') }}"
                                                    value="{{$post->translate($key)->tags}}">
                                                <span class="help-block text-danger">
                                                    @error('tags:' . $key)
                                                        {{ __($message) }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="card-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-md btn-success "><i class="fa fa-dot-circle-o"></i>
                                    {{ __('words.save data') }}</button>
                                <a href="{{ route('posts.index') }}" class="btn btn-md btn-danger">
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
