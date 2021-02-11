@extends('layouts.fixed')
@section('title','Goods in  - CDF ')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage  Goods In </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Goods In </li>
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
                                <h3 class="card-title">Add Inventory Goods In </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                {{ Form::open(['route'=>'goodsin.store','method'=>'post', 'class'=>'form-horizontal']) }}
                                <div class="row">
                                    @include('inventory.goodsin.form-goodsin')
                                    <hr>

                                    <div class="col-lg-12">
                                        <h6 class="text-center bg-primary" style="padding:5px 0;font-size: 1.5rem;font-weight: bold;letter-spacing: 10px">Product List</h6>
                                        <hr>
                                        <table class="table-hover table-bordered  table goodsinProList">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Item</th>
                                                    <th>Department</th>
                                                    <th>Group</th>
                                                    <th>Req.QTY</th>
                                                    <th>Rcvd.Qty</th>                                                    
                                                    <th>Balance Qty</th>                                                    
                                                    <th>Price</th>
                                                    <th>RCV. QTY</th>
                                                    <th>Remaining Now</th>

                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>

                                            <tbody class="proList">

                                                <tr>
                                                    <td colspan="11" class="text-center bg-danger">No Product Information Found</td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="col-lg-9"></div>


                                    <div class=" col-lg-offset-9  col-lg-4">
                                        <div class="form-group">
                                            {{ Form::label('','Goods in Note : ') }}
                                            {{ Form::textarea('note',null,['class'=>'form-control','placeholder'=>'Ex. Goods in Note ','rows'=>5,'cols'=>5  ]) }}
                                        </div>
                                    </div>


                                    <div class="col-lg-8"></div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            {{ Form::submit('Save Goods In',['class'=>'form-control btn btn-info']) }}
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
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

        var gtable ;

        $(document).ready(function () {
          //  gtable = $(".goodsinProList").DataTable();
        });

        $(document).on('change','.purchase_id',function () {
            var purchase_id = $(this).val();
            var token = '{{ csrf_token() }}';

            if (purchase_id !=''){


               $.ajax({
                   method:"post",
                   url:'{{ route('purchase.productList') }}',
                   data:{purchase_id:purchase_id,_token:token},
                   dataType:'html',
                   success:function (res) {

                        $('.proList').html(res);
                   }
               })
            }

        });


        $(document).on('keyup','.qtyCheck',function () {
            var qty = $(this).attr('data-qty');
            var rcvqty = $(this).val();
            var rowId = $(this).attr('data-rowid');

            if (Number(rcvqty) <= Number(qty)){
                $(this).css({'border':"5px solid #17A05D"});
                balance = Number(qty)-Number(rcvqty);
                $("#rowId"+rowId).html(balance);
            }else{
                $(this).val(0);
                $(this).css({'border':"5px solid #DD5044"});
            }

        });

    </script>
@stop