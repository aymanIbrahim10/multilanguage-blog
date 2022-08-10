@extends('layouts.dashboard')
@section('title',__('words.users') . ' | ' . __('words.user privacy'))
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
            <li class="breadcrumb-item active">{{ __('words.user privacy') }}</li>
        </ol>
        <div class="container-fluid">
         @include('dashboard.alerts.error')
                @include('dashboard.alerts.success')
            <div class="animated fadeIn">
            <form action="{{ route('users.edit.pass.update',$user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('words.password edit') }}</strong>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="password">{{ __('words.user old password') }} : </label>
                                        <input type="password" id="password" name="oldpassword" class="form-control"
                                            placeholder="{{ __('words.user password') }}"
                                            >
                                        <span class="help-block text-danger">
                                            @error('oldpassword')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

<div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="password">{{ __('words.user new password') }} : </label>
                                        <input type="password" id="password" name="newpassword" class="form-control"
                                            placeholder="{{ __('words.user password') }}"
                                            >
                                        <span class="help-block text-danger">
                                            @error('newpassword')
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
                                            @error('password_confirmation')
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
                </form>
                </div>
                </div>
                </main>

@endsection  
