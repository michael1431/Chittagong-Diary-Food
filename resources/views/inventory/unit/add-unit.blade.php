@extends('layouts.fixed')

@section('title','Save-UNit Inventory')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Unit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Unit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">

            <div class="card"><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h2 class="text-info text-center">Add A Unit</h2><hr>
                            {!! Form::open(['method'=>'POST', 'class'=>'form-horizontal']) !!}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {{Form::label('details', 'Unit Name', ['class'=>'label-control'])}}
                                {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Enter Grade name','autofocus','required']) }}

                                    @if ($errors->has('name'))
                                        <span class="help-block text-center" id="success-alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                {{Form::label('details', 'Unit Description', ['class'=>'label-control'])}}
                                {{ Form::textarea('details',old('details'),['class'=>'form-control','placeholder'=>'shortly Brief about Unit','rows'=>5,'cols'=>5]) }}


                                    @if ($errors->has('details'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <div class="">
                                    {{ Form::submit('Save Unit', ['class'=>'btn btn-success btn-block']) }}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="col-lg-8">

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    <strong>{{ session()->get('success') }}</strong>
                                </div>

                            @endif
                            <table class="table table-hover table-bordered">
                                <thead>
                                <th colspan="5"> <h1 class="text-center text-info">Grade's List</h1></th>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @for($i=1;$i<10;$i++)
                                    <tr>
                                        <td> {{ $i }} </td>
                                        <td> Well-Group Unit {{ $i }} </td>
                                        <td> Unit description {{ $i }} </td>
                                        <td>
                                            <a href="#" class="btn btn-success fa fa-edit"></a> &nbsp; &nbsp;
                                             <a href="#" class="fa fa-trash-alt btn btn-danger" onclick="return confirm('Are you sure to delete it?')"></a>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

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
            window.setTimeout(function() {
                $(".alert").slideUp(1000, function(){
                    $(this).remove();
                });
            }, 1200);

        });
    </script>

@stop
