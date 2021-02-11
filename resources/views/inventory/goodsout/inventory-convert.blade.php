@extends('layouts.fixed')

@section('title','Transform Inventory')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventory Transform</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Inventory Transform</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            {{ Form::open(['route'=>'inventory.goodsin_out.store','method'=>'post','id'=>'PurchaseForm','class'=>'form-horizontal']) }}
            <div class="row">

                <div class="col-lg-4">
                    <div class="form-group">
                    @if(!request('consume_product') && !request('damage_product'))
                    <a href="{{route('inventory.goodsin_out.create',['consume_product=1'])}}" class="btn btn-info btn-xs">Consume Product</a>
                    <a href="{{route('inventory.goodsin_out.create',['damage_product=1'])}}" class="btn btn-info btn-xs">Damage Product</a>
                    @else
                    <a href="{{route('inventory.goodsin_out.create')}}" class="btn btn-info btn-xs">Add FinishedGoods from RawGoods</a>
                    @endif
                    </div>
                    @if(request('consume_product'))
                    <div class="form-group">
                        {{ Form::label('','Employee') }}
                        <select name="emp_id" class="form-control">
                            <option value="0">Select Employee</option>
                            @foreach($employees as $employee)
                                    <option value="{{$employee->id}}"> {{ $employee->name." -- ".$employee->phone1 }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('','Consume Product') }}
                        <select name="consume_product_id" class="form-control" required>
                            <option value="0">Select Product</option>
                            @foreach($consumableProducts as $product)
                                @if(($product->accesories->sum('stock_in_qty') - $product->accesories->sum('stock_out_qty') ) > 0)
                                    <option value="{{$product->id}}"> {{ $product->id." -- ".$product->name." -- ".($product->accesories->sum('stock_in_qty') - $product->accesories->sum('stock_out_qty'))}}
                                     </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(!request('consume_product') && !request('damage_product'))
                    <div class="form-group" id="raw_product_option" style="display:block">
                        {{ Form::label('','Raw Product') }}
                        <select name="raw_product_id" class="form-control" required>
                            <option value="0">Select Product To be Convert Into Finished Goods</option>
                            @foreach($stockedProducts as $product)
                                @if(($product->stocks) && ( $product->stocks->sum('qty') - $product->stocks->sum('stock_out_qty') ) > 0)
                                    <option value="{{$product->id}}"> {{ $product->id." -- ".$product->name." -- ".($product->stocks->sum('qty')-$product->stocks->sum('stock_out_qty')) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @endif
                   
                    <div class="form-group">
                        @if(!request('damage_product'))
                        {{ Form::label('','StockOut Qty') }}
                        <input type="number" name="stock_out_qty" class="form-control">
                        @endif
                            @if(request('consume_product'))
                                <input type="hidden" name="consume_product" value="1">
                            @endif
                            @if(request('damage_product'))
                                <input type="hidden" name="damage_product" value="1">
                            @endif
                    </div>
                    @if(!request('consume_product'))
                    <div class="form-group">
                        {{ Form::label('',request('damage_product')?'Damage Product':'Finished Product') }}
                        <select name="finished_product_id" class="form-control" required>
                            <option value="0">Finished Goods</option>
                            @foreach($finishGoods as $finishGood)
                                    <option value="{{$finishGood->id}}"> {{ $finishGood->id." -- ".$finishGood->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('',request('damage_product')?'Damage Goods Qty':'Finish Goods Qty') }}
                        <input type="number" name="stock_in_qty" class="form-control" required>
                    </div>
                    <div class="form-group">
                        {{ Form::label('',request('damage_product')?'Price':'CostOfGoods per Qty') }}
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    @endif
                </div>

                <div class="col-lg-8">
                    {{ Form::label('','Stock Transformation Note : ') }}
                    {{ Form::textarea('note',null,['class'=>'form-control','rows'=>5,'cols'=>5,'placeholder'=>'Stock Transformation Note......']) }}
                </div>

                <div class="col-lg-3">
                    {{ Form::submit('Confirm Stock Transform',['class'=>'form-control btn btn-info']) }}
                </div>

            </div><!-- /.row -->
            {{ Form::close() }}
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

        function empToggle() {
           var type= document.getElementById("stock_out_type").value;
           //alert(type);
            if(type=='2'){
                document.getElementById("emp_option").style.display ='block';
                document.getElementById("lc_cost_option").style.display ='none';
                $("#amount").attr('readonly',true);

            }else if(type=='3'){
                document.getElementById("qty_option").style.display ='none';
                document.getElementById("lc_cost_option").style.display ='block';
                $("#amount").attr('readonly',false);
            }else{
                document.getElementById("qty_option").style.display ='none';
                document.getElementById("lc_cost_option").style.display ='none';
                $("#amount").attr('readonly',false);
            }     
        }

    </script>

@stop
