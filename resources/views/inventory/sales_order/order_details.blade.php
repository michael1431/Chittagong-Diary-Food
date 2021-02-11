@extends('layouts.fixed')
@section('title','Sales Details  - CDF ')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Sales</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
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
                            <h3 class="card-title">Invoice No: {{ $invoice->invoice_no }}</h3>
                                
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                              
                                <div class="row">
                                    <hr>

                                    <div class="col-lg-12">
                                        <h6 class="text-center bg-primary" style="padding:5px 0;font-size: 1.5rem;font-weight: bold;letter-spacing: 10px">Product List</h6>
                                        <hr>
                                          {{ Form::open(['route'=>'sales.store','method'=>'post', 'class'=>'form-horizontal']) }}
                                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                        <table class="table-hover table-bordered  table goodsinProList">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center">SL</th>
                                                    <th rowspan="2" class="text-center">Item</th>
                                                    {{-- <th>Department</th>
                                                    <th>Group</th> --}}
                                                    <th rowspan="2" class="text-center">inStockQty</th>
                                                    <th rowspan="2" class="text-center">OrderedQTY</th>
                                                    <th rowspan="2" class="text-center">QTY</th>
                                                    <th rowspan="2" class="text-center">Price</th>                                                    
                                                    <th colspan="2" class="text-center">Commission</th>
                                                </tr>
                                                <tr>   
                                                     <th class="text-center"><label class="checkbox-inline"><input type="checkbox" value="mar" id="market" onclick="show_amount(2)"> Marketing</label></th>
                                                    <th class="text-center"><label class="checkbox-inline"><input type="checkbox" value="emp" id="employee" onclick="show_amount(1)"> Employee</label></th>
                                                
                                                </tr>
                                            </thead>

                                            <tbody class="proList">
                                                @forelse($sales_details as $key=>$sale)
                                                <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $sale->product->name }}</td>
                                                        <td class="text-right"> {{ $sale->product->stocks->sum('qty') -$sale->product->stocks->sum('stock_out_qty') }} </td>
                                                        <td class="text-right"> {{ $sale->qty }} </td>
                                                        <td class="text-right">
                                                            <div class="form-group"> <input class="form-control-sm" type="number" value="{{ $sale->qty }}" name="qty[{{$sale->id}}]" min="1" max="{{ $sale->product->stocks->sum('qty') -$sale->product->stocks->sum('stock_out_qty') }}"></div>
                                                        </td>
                                                        <td class="text-right"> {{ $sale->price }} </td>
                                                        <td>
                                                            <div class="form-group"> <input class="form-control-sm mar_commission" type="number" value="0" data-marcommission="{{ $sale->product->marketing_commission }}" step=".01" name="mar_commission[{{$sale->id}}]"></div>
                                                            
                                                        </td>
                                                        <td><div class="form-group">  <input class="form-control-sm emp_commission" size="3" type="number" value="0" data-empcommission="{{ $sale->product->employee_commission }}"  step=".01" name="emp_commission[{{$sale->id}}]"> </div></td>
                                                       
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center bg-danger">No Product Information Found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="col-lg-9"></div>


                                    <div class=" col-lg-offset-9  col-lg-4">
                                        <div class="form-group">
                                            {{ Form::label('','Confirm Order : ') }}
                                            {{ Form::textarea('note',null,['class'=>'form-control','placeholder'=>'Ex. Goods in Note ','rows'=>5,'cols'=>5  ]) }}
                                        </div>
                                    </div>


                                    <div class="col-lg-8"></div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            {{ Form::submit('Confirm Order',['class'=>'form-control btn btn-info']) }}
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
        <script>
        function show_amount(type){
            if(type==2){
               var cks=$("#market").is(':checked');
                $(".mar_commission").each(function(){
                    //console.log($(this).attr("data-marcommission"));
                    $(this).val(cks ? $(this).attr("data-marcommission") : 0);
                });
            }
            if(type==1){
                var cks=$("#employee").is(':checked');
                $(".emp_commission").each(function(){
                    //console.log($(this).attr("data-empcommission"));
                    $(this).val(cks ?$(this).attr("data-empcommission") : 0);
                });
            }
        }
        </script>
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
    {{-- <script type="text/javascript">

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

    </script> --}}
@stop