@extends('layouts.fixed')
@section('title','Cost - Inventory CDF ')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage  Cost </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Cost </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">
            <div class="row">
                {{--create/edit start --}}
                <div class="col-lg-4">
                    <div class=" bg-light">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit Cost </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                {{ Form::model($cost,['route'=>['cost.update',$cost->id],'method'=>'POST', 'class'=>'form-horizontal']) }}
                                @include('inventory.cost.form-cost',['buttonText'=>'Update Warehouse'])
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                {{--create/edit  start --}}

                {{--list  start --}}
                <div class="col-md-8">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-info">Inventory Cost Lists </h5>
                            </div>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            @include('inventory.cost.costs')
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                {{--list end--}}

            </div>
        </div>
        </div>

    </section><!-- /.content -->
@stop

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
@stop

@section('plugin')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script>
@stop

@section('script')
    <!-- page script -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#ProunitTable").DataTable();
        });

    </script>
@stop