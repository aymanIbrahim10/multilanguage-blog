@extends('layouts.dashboard')
@section('title', __('words.settings'))
@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('words.home') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('words.dashboard home') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('words.settings') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('dashboard.alerts.error')
                @include('dashboard.alerts.success')

                <form action="{{ route('settings.update', $setting) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="card">
                            <input name="id" value="{{ $setting->id }}" type="hidden">
                            <div class="card-header">
                                <strong>{{ __('words.add board') }}</strong>
                            </div>
                            <div class="card-block">
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <img id="file-ip-1-preview" src="{{ asset($setting->logo) }}"
                                        alt="{{ __('words.website favicon') }}"
                                        style="
                                    height: 100px;
                                    width: 100px;
                                    border-radius: 8px;
                                    border: 2px solid #ddd;
                                ">
                                    <div class="form-group">
                                        <label for="file-ip-1">{{ __('words.website logo') }} : </label>
                                        <input type="file" name="logo" class="form-control" id="file-ip-1"
                                            accept="image/*" onchange="showPreview(event);">
                                        <span class="help-block text-danger text-danger">
                                            @error('logo')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <img src="{{ asset($setting->favicon) }}" id="favicon-preview"
                                        alt="{{ __('words.website favicon') }}"
                                        style="
                                    height: 100px;
                                    width: 100px;
                                    border-radius: 8px;
                                    border: 2px solid #ddd;
                                ">
                                    <div class="form-group">
                                        <label for="favicon-ip-1">{{ __('words.website favicon') }} : </label>
                                        <input type="file" name="favicon" class="form-control" id="favicon-ip-1"
                                            accept="image/*" onchange="faviconPreview(event);">
                                        <span class="help-block text-danger">
                                            @error('favicon')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="facebook">{{ __('words.facebook link') }} : </label>
                                        <input type="text" id="facebook" name="facebook" class="form-control"
                                            placeholder="{{ __('words.enter your site facebook link') }}"
                                            value="{{ $setting->facebook }}">
                                        <span class="help-block text-danger">
                                            @error('facebook')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="instagram">{{ __('words.instagram link') }} : </label>
                                        <input type="text" id="instagram" name="instagram" class="form-control"
                                            placeholder="{{ __('words.enter your site instagram link') }}"
                                            value="{{ $setting->instagram }}">
                                        <span class="help-block text-danger">
                                            @error('instagram')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="phone">{{ __('words.phone num') }} : </label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            placeholder="{{ __('words.enter phone number of your site') }}"
                                            value="{{ $setting->phone }}">
                                        <span class="help-block text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('words.email') }} : </label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="{{ __('words.enter your site email address') }}"
                                            value="{{ $setting->email }}">
                                        <span class="help-block text-danger">
                                            @error('email')
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
                                    {{-- value="{{ old('title:' . $key) }} --}}
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach (config('app.avaiable_lang') as $key => $lang)
                                        <div class="tab-pane fade show @if ($loop->index == 0) active in @endif"
                                            id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                            </br>
                                            <div class="form-group mt-2 col-md-12">
                                                <label> {{ __('words.site name') }} : ( {{ $lang }} ) </label>
                                                <input type="text" class="form-control"
                                                    name="title:{{ $key }}" id="title:{{ $key }}"
                                                    value="{{ $setting->translate($key)->title }}"
                                                    placeholder="{{ __('words.enter your website name') }}">
                                                <span class="help-block text-danger">
                                                    @error('title:' . $key)
                                                        {{ __($message) }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group mt-2 col-md-12">
                                                <label> {{ __('words.site desc') }} : ( {{ $lang }} ) </label>
                                                <input type="text" name="describtion:{{ $key }}"
                                                    id="describtion:{{ $key }}" class="form-control"
                                                    placeholder="{{ __('words.enter small describtion for your site') }}"
                                                    value="{{ $setting->translate($key)->describtion }}">
                                                <span class="help-block text-danger">
                                                    @error('describtion:' . $key)
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
                                <button type="reset" class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    {{ __('words.go back') }}</button>
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
