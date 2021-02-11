@extends('layouts.fixed')

@section('title','Item - Inventory CDF ')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage  Item  </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Item  </li>
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
                                <h3 class="card-title">Add Item </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                {{ Form::open(['route'=>'inventory.item.store','method'=>'POST', 'class'=>'form-horizontal']) }}
                                @include('inventory.item.form-item-inventory',['buttonText'=>'Save Item'])
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
                                <h5 class="text-info">Inventory Item list </h5>
                            </div>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block; min-height: 707px;">
                            {{ Form::label('','Show Product according to ProductType ') }}

                            {{ Form::select("searching",$groups,null,['class'=>'form-control department_id','placeholder'=>'Select Product Type']) }}

                            <hr>
                            @include('inventory.item.items-inventory')
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                {{--list end--}}

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
        var table;
        $(document).ready(function () {
            $('#productTable').dataTable();
        });


        $(document).on("change",".department_id",function () {
            var group_id = $(this).val();

            $('#productTable').dataTable({
                'destroy': true,
                'paging': true,
                'searching': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'paginate':true,
                "paginType": "full_numbers",
                "aLengthMenu": [10,100,200,500],
                "stateSave": true,
                "ajax": {
                    'url': '{{ route('groupwise.productList') }}',
                    'data': { group_id:group_id,_token:'{{ csrf_token() }}'},
                },
                "columns": [
                    { "data": "sl" },
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "group" },
                    { "data": "unit" },
                    { "data": "department" },
                    { "data": "price" },
                    { "data": "description" },
                    { "data": "edit" }
                ]
            });
        });

      /*  $(document).on("change",".department_id",function () {
            var group_id = $(this).val();
            table.clear().draw();
            var row = "<tr> <td colspan='9' style='background: red;padding: 10px;color: #fff3cd;font-size: 1rem;text-align: center;'> Please wait item loading ............. </td>  </tr>";
            $("#tbodyItem").html(row);

            $.ajax({
                method:"post",
                url : "{{ route('groupwise.productList') }}",
                data : { group_id:group_id,_token:'{{ csrf_token() }}'},
                dataType:'json',
                success:function (response) {
                    for (var i=0;i<response.success.sl.length;i++){
                        table.row.add([
                            response.success.sl[i],
                            response.success.code[i],
                            response.success.name[i],
                            response.success.department[i],
                            response.success.group[i],
                            response.success.unit[i],
                            response.success.price[i],
                            response.success.description[i],
                            response.success.edit[i]
                        ]).draw();
                    }
                }
            })
        });*/


        /* datatable Ajax Processing start */



        /* Datatable Ajax Processing End */

    </script>
@stop