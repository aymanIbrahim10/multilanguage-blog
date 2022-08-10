@extends('layouts.dashboard')
@section('title', __('words.categories') . ' | ' . __('words.add category'))
@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('words.home') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('words.dashboard home') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('words.categories') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('dashboard.alerts.error')
                @include('dashboard.alerts.success')

                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('words.add board') }}</strong>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <img id="file-ip-1-preview" src="{{ asset('dashboard/img/default/default.png') }}"
                                        alt="{{ __('words.category image') }}"
                                        style="
                                    height: 100px;
                                    width: 100px;
                                    border-radius: 8px;
                                    border: 2px solid #ddd;">
                                    <div class="form-group">
                                        <label for="file-ip-1">{{ __('words.category image') }} : </label>
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
                                        <label>{{ __('words.category type') }}</label>
                                        <select name="parent" id="" class="form-control">
                                            <option value="0">{{ __('words.main category') }}</option>


                                            @foreach ($categories as $category)
                                                    <option class="divider"
                        
                                                        value="{{ $category->id }}">{{ $category->title }}</option>

                                            @endforeach

                                        </select>
                                        <span class="help-block text-danger text-danger">
                                            @error('parent')
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
                                                <label> {{ __('words.category name') }} : ( {{ $lang }} ) </label>
                                                <input type="text" class="form-control" name="title:{{ $key }}"
                                                    id="title:{{ $key }}" value="{{ old('title:' . $key) }}"
                                                    placeholder="{{ __('words.enter your website name') }}">
                                                <span class="help-block text-danger">
                                                    @error('title:' . $key)
                                                        {{ __($message) }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group mt-2 col-md-12">
                                                <label> {{ __('words.category desc') }} : ( {{ $lang }} ) </label>
                                                <input type="text" name="content:{{ $key }}"
                                                    id="content:{{ $key }}" class="form-control"
                                                    placeholder="{{ __('words.enter small describtion for your site') }}"
                                                    value="{{ old('content:' . $key) }}">
                                                <span class="help-block text-danger">
                                                    @error('content:' . $key)
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

                                <a href="{{ route('categories.index') }}" class="btn btn-md btn-danger">
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
