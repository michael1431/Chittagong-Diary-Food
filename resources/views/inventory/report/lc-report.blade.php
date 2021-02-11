@extends('layouts.fixed')
@section('title','Goods in  - CDF ')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage  LC Report </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage LC Report </li>
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
                <div class="col-lg-12">
                    <div class=" bg-light">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Add Inventory LC Report </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-lg-3">
                                        @include('inventory.report.form-lc',['buttonText'=>'Search LC'])
                                    </div>
                                    <div class="col-lg-9 table-responsive" style="background: #ffffff;">

                                        <table class="table table-hover" id="lcreport">
                                            <thead>
                                            <tr>
                                                <th class="text-center">SL</th>
                                                <th class="text-center">LC No   </th>
                                                <th class="text-center">Cost Type </th>
                                                <th class="text-center">Amount </th>
                                                <th class="text-center">Created Date & Time </th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="lc_wise_report">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--create/edit  start --}}



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
            table = $("#lcreport").DataTable();
        });


        $(document).on('click','.getGoodsIn',function () {
            var lc_no = $('#lc_no').val();
                $('#lc_wise_report').empty();
            //table.clear().draw();

            $.ajax({
                method:"post",
                url:"{{ route('lc.reportFind') }}",
                data:{lc_no:lc_no,_token:"{{ csrf_token() }}"},
                //dataType:'json',
                success:function (response) {
                    // console.log(response);
                    $('#lc_wise_report').html(response);
                    // var loop = response.success.sl.length-1;
                    // for (var i=0; i<=loop; i++){
                    //     table.row.add([
                    //         response.success.sl[i],
                    //         response.success.lc[i],
                    //         response.success.cost[i],
                    //         response.success.amount[i],
                    //         response.success.time[i]
                    //     ]).draw();
                    // }
                }
            });

        });

    </script>
@stop