@extends('layouts.fixed')

@section('title','Requisition Inventory')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>File Read</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Files</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Main content -->
                <div class="col-lg-12">
                    {{ Form::open(['route'=>'file.store','method'=>'post','files'=>true]) }}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                {{ Form::label('','File Upload') }}
                                {{ Form::file('excel',['class'=>'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-8">

                        </div>

                    </div>
                    {{ Form::submit('Upload',['class'=>'btn btn-primary']) }}
                    {{ Form::close() }}

                </div>
                <!-- /.invoice -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
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


    </script>

@stop
