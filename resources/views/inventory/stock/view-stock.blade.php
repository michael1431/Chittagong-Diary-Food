@extends('layouts.fixed')

@section('title','Stock-Summary Inventory')

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
                    <h1>Manage Stock</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Stock</li>
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
                        <div class="col-lg-12">
                            <h2 class="text-info text-center">STOCK REPORT</h2><hr>
                                <div class="row">
                                    {{-- <div class="col-lg-2">
                                        <div class="form-group">
                                            {{ Form::label('','Select Product Type') }}
                                            {{ Form::select('department_id',$sections,false,['class'=>'form-control commonStock','data-type'=>1,'placeholder'=>'Select Product Type']) }}
                                        </div>
                                    </div>


                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            {{ Form::label('','Select Group') }}
                                            {{ Form::select('group_id',$groups,false,['class'=>'form-control  commonStock','data-type'=>2,'placeholder'=>'Select Group']) }}
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            {{ Form::label('','Select Product') }}
                                            {{ Form::select('product_id',$products,false,['class'=>'form-control product_id ','data-type'=>3]) }}

                                        </div>
                                    </div>
                                </div>


                            <hr>

                            <table class="table table-hover table-bordered" id="stockTable">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Group</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody class="stockList">
                                @php $sl=0; @endphp

                                    @foreach($return_data as $key=>$info)

                                    {{-- @php
                                    $qty=0;
                                    foreach($info as $inf){
                                        $name= $inf->product->name;
                                        $department= $inf->product->department->name;
                                        $group= $inf->product->group->name;
                                        $qty=$qty+$inf->qty;
                                        $qty=$qty-$inf->stock_out_qty;
                                    }
                                    @endphp --}}
                                        <tr>
                                            <td>{{ ++$sl }}</td>
                                            <td>{{ $info['name'] }}</td>
                                            <td>{{ $info['department'] }}</td>
                                            <td>{{ $info['group'] }}</td>
                                            <td>{{ $info['qty'] }}</td>
                                        </tr>
                                    @endforeach

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@stop

@section('plugin')
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
@stop

@section('script')
    <!-- page script -->

    <script type="text/javascript">
        var table ;

        // $(document).ready(function () {
        //     table = $("#stockTable").DataTable();
        // });

        $(document).on('change','.product_id',function () {

            var product_id = $(this).val();
            var token = '{{ csrf_token() }}';

            // var department_id = $("SELECT[name='department_id']").val();
            // var group_id = $("SELECT[name='group_id']").val();

            if(product_id != ''){
                // table.clear().draw();
                // var tr = '<tr> <td colspan="5" class="bg-secondary text-center" style="padding: 10px;font-size: 1.3rem;text-transform: uppercase;font-weight: bold;letter-spacing: 28px;"> Stock Loading .... </td> </tr>';
                // $(".stockList").html(tr);
                $.ajax({
                    method:"post",
                    url:"{{ route('stock.retrive') }}",
                    data:{
                        product_id:product_id,
                        // department_id:department_id,
                        // group_id:group_id,
                        _token:token},
                    // dataType:'json',
                    success:function (res) {
                        $('#stockTable').html(res);
                        // if(res.success == 0){
                        //     var tr = '<tr> ' +
                        //         '<td colspan="5" class="bg-danger text-center" style="padding: 10px;font-size: 1.3rem;text-transform: uppercase;font-weight: bold;letter-spacing: 28px;">' +
                        //         ' Stock not available </td>' +
                        //         '</tr>';
                        //     $(".stockList").html(tr);
                        // }else{
                        //     var loop = res.success.sl.length-1;
                        //     for(i=0;i<=loop;i++){
                        //         table.row.add([
                        //             i+1,
                        //             res.success.name[i],
                        //             res.success.department[i],
                        //             res.success.group[i],
                        //             res.success.qty[i],
                        //         ]).draw();
                        //     }
                        // }
                    }
                });
            }
        });




        /* Comman Stock Hit */

        // $(document).on('change','.commonStock',function () {
        //     var id = $(this).val();
        //     var type = $(this).attr('data-type');
        //     var token = '{{ csrf_token() }}';

        //     if(id != ''){
        //         table.clear().draw();
        //         var tr = '<tr> <td colspan="5" class="bg-secondary text-center" style="padding: 10px;font-size: 1.3rem;text-transform: uppercase;font-weight: bold;letter-spacing: 28px;"> Stock Loading .... </td> </tr>';
        //         $(".stockList").html(tr);
        //         $.ajax({
        //             method:"post",
        //             url:"{{ route('cdf.stockreport') }}",
        //             data:{id:id,type:type,_token:token},
        //             dataType:'json',
        //             success:function (res) {
        //                 if(res.success == 0){

        //                     var tr = '<tr> <td colspan="5" class="bg-danger text-center" style="padding: 10px;font-size: 1.3rem;text-transform: uppercase;font-weight: bold;letter-spacing: 28px;"> Stock not available </td> </tr>';
        //                     $(".stockList").html(tr);
        //                 }else{
        //                     var loop = res.success.sl.length-1;
        //                     for(i=0;i<=loop;i++){
        //                         table.row.add([
        //                             i+1,
        //                             res.success.name[i],
        //                             res.success.department[i],
        //                             res.success.group[i],
        //                             res.success.qty[i],
        //                         ]).draw();
        //                     }
        //                 }

        //             }
        //         });

        //     }
        // });

    </script>

@stop
