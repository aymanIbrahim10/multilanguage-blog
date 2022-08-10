@extends('layouts.dashboard')
@section('title', __('words.dashboard home'))
@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('words.home') }}</li>
            <li class="breadcrumb-item active">{{ __('words.dashboard home') }}</li>

            <!-- Breadcrumb Menu-->
        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <button type="button" class="btn btn-transparent active  p-a-0"
                                        >
                                        <i class="icon-user"></i>
                                    </button>
                                </div>
                                <h4 class="m-b-0">
                                    {{ App\Models\User::count() }}
                                </h4>
                                <h3>{{ __('words.all users') }}</h3>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-info">
                            <div class="card-block p-b-0">
                                <button type="button" class="btn btn-transparent active p-a-0 pull-left">
                                    <i class="icon-location-pin"></i>
                                </button>
                                <h4 class="m-b-0">{{ App\Models\Post::count() }}</h4>
                                <h3>{{ __('words.posts') }}</h3>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart2" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-warning">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <button type="button" class="btn btn-transparent active p-a-0"
                                        >
                                        <i class="icon-settings"></i>
                                    </button>
                                </div>
                                <h4 class="m-b-0">{{ App\Models\Post::where('user_id' , auth()->user()->id)->count() }}</h4>
                                <h3>{{ __('words.my posts') }}</h3>
                            </div>
                            <div class="chart-wrapper" style="height:70px;">
                                <canvas id="card-chart3" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-danger">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <button type="button" class="btn btn-transparent active p-a-0"
                                        >
                                        <i class="icon-settings"></i>
                                    </button>
                                    
                                </div>
                                <h4 class="m-b-0">9.823</h4>
                                <p>کاربر آنلاین</p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart4" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                </div>
                <!--/row-->
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
