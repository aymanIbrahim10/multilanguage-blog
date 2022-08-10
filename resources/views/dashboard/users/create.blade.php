@extends('layouts.dashboard')
@section('title', __('words.users') . ' | ' . __('words.add user'))
@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('words.home') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('words.dashboard home') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('words.add user') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('dashboard.alerts.error')
                @include('dashboard.alerts.success')

                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                @method('POST')
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('words.add board') }}</strong>
                            </div>
                            <div class="card-block">

<div class="col-md-12 col-sm-12 col-lg-12">
                                    <img id="file-ip-1-preview" src="{{ asset('dashboard/img/default/default.png') }}" alt="{{ __('words.user avatar') }}"
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
                                            >
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
                                            >
                                        <span class="help-block text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="password">{{ __('words.user password') }} : </label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="{{ __('words.user password') }}"
                                            >
                                        <span class="help-block text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="confirm">{{ __('words.user password confirm') }} : </label>
                                        <input type="password" id="confirm" name="password_confirmation" class="form-control"
                                            placeholder="{{ __('words.user password confirm') }}"
                                            >
                                        <span class="help-block text-danger">
                                            @error('confirm')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label>{{ __('words.user type') }}</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="admin">{{__('words.admin')}}</option>
                                            <option value="writer">{{__('words.writer')}}</option>
                                        </select>
                                        <span class="help-block text-danger">
                                            @error('status')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

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
