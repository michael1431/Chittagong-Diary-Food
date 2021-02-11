@extends('layouts.fixed')

@section('title','Manage Quotation - Purcahse Quotation')

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
                    <h1>Quotation Make</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Quotation</li>
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
                        {{-- requisition  lists start --}}
                        <div class="col-lg-12 table-responsive">

                            <h4 class="text-left " >Requisition No :  <label style="padding: 5px 15px;" class="label-info">  {{ $invoice_requisition->id }} </label><br> Requisition Invoice : <label  style="padding: 5px 15px;" class="label-info">  {{ $invoice_requisition->invoice_no }} </label> </h4>
                            <br>

                            <table class="table-bordered table-striped table">
                                <thead>
                                <tr>
                                    <th> #SL</th>
                                    <th> Item Name</th>
                                    <th> Item Code</th>
                                    <th> Product Type</th>
                                    <th> Group</th>
                                    <th> Unit</th>
                                    <th> Price</th>
                                </tr>
                                </thead>
                                {{ Form::open(['route'=>['inventory.quotation.store',$invoice_requisition->id]]) }}
                                @php $i=0; @endphp
                                @if($quotations->count()>0)
                                    @foreach($quotations as $requisition)
                                        <tr>
                                            <td> {{ ++$i }} </td>
                                            <td> {{ $requisition->product ? $requisition->product->name : "N/A" }} </td>
                                            <td> {{ $requisition->product ? $requisition->product->item_code : "N/A" }} </td>
                                            <td> {{ $requisition->product->department ? $requisition->product->department->name : "N/A" }} </td>
                                            <td> {{ $requisition->product->group ? $requisition->product->group->name : "N/A" }} </td>
                                            <td> {{ $requisition->product->unit ? $requisition->product->unit->name : "N/A" }} </td>
                                            <td>
                                                <input type="hidden" name="requisition_product_id[]" value="{{ $requisition->id }}" class="form-control"/>
                                                <input type="number" name="price[]" value="{{ $requisition->price }}" class="form-control"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tbody>

                            </table>
                            <br>

                        </div>
                        {{-- requisition  lists End --}}



                        <div class="col-lg-12">
                            {{ Form::textarea('note',null,['class'=>'form-control','rows'=>5,'cols'=>5,'placeholder'=>'Quotation Note ']) }}
                            <br>
                        </div>

                        <div class="col-lg-4">
                            <select name="supplier_id" class="form-control">
                                <option value="{{ 0 }}">Select Supplier / Party</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"> {{ $supplier->name ."-". $supplier->phone }}</option>
                                @endforeach
                            </select>
                            <span style="height: 10px; display: block;background: #fff;"></span>
                        </div>

                        <div class="col-lg-4">
                            {{ Form::submit('Save Quotation',['class'=>'form-control btn-info']) }}
                        </div>

                        {{ Form::close() }}



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

    <!-- page script -->
    <script type="text/javascript">

    </script>
@stop
