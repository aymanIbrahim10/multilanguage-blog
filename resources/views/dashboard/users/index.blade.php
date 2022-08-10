@extends('layouts.dashboard')
@section('title', __('words.users'))
@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('words.home') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('words.dashboard home') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('words.users') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('dashboard.alerts.error')
                @include('dashboard.alerts.success')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{__('words.all users')}}
                        </div>
                        <div class="card-block">
    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>{{__('words.user avatar')}}</th>
                <th>{{__('words.user name')}}</th>
                <th>{{__('words.user email')}}</th>
                <th>{{__('words.user type')}}</th>
                <th>{{__('words.start date')}}</th>
                <th>{{__('words.action')}}</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

                        </div>
                    </div>
            </div>
        </div>

        {{-- delete --}}
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ Route('users.delete') }}" method="POST">
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        @csrf

                        <div class="form-group">
                            <h3>{{ __('words.sure delete') }}
                                    </h3>
                                    <p><h4>{{ __('words.delete msg') }}</h4></p>
                            @csrf
                            <input type="hidden" name="id" id="id">
                        </div>



                    </div>
                    <div class="modal-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-danger">{{ __('words.delete') }} </button>

                                <button type="button" class="btn btn-info"
                                    data-dismiss="modal">{{ __('words.close') }}</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- delete --}}
</main>
@endsection 
@push('javascripts')
<script type="text/javascript">

    $(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.all') }}",
            columns: [{
                    data: 'avatar',
                    name: 'avatar'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
    $('#myTable tbody').on('click', '#deleteBtn', function(argument) {
        var id = $(this).attr("data-id");
        console.log(id);
        $('#deletemodal #id').val(id);
    })
</script>
@endpush
