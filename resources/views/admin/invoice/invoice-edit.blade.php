@extends('layouts.master')

@section('title','Sales Return -CDF')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Return</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Return</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i>{{ ($invoice->total_amount > 0) ?"INVOICE" : "MONEY RECEIPT"}}
                                    <small class="float-right">Date: {{ \Carbon\Carbon::now()->format('Y/m/d')}}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Bill For
                                @if($invoice->related_party_type=='Supplier')
                                <address>
                                    <strong> {{ $invoice->supplier->name }} </strong><br>
                                    Address : {{ $invoice->supplier->address }}
                                    <br> Phone:  {{ $invoice->supplier->phone }}<br>
                                    Email: N / A
                                </address>
                                @endif
                                @if($invoice->related_party_type=='Customer')
                                <address>
                                   
                                    <strong> {{ $invoice->customer->name }} </strong><br>
                                    Address : {{ $invoice->customer->address }}
                                    <br> Phone:  {{ $invoice->customer->phone1 }},{{ $invoice->customer->phone2 }}
                                </address>
                                @endif
                            </div> 
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <address class="text-center">
                                    <strong>{{ company_info()->company_name }}</strong><br>
                                    {{ str_before(company_info()->address,'|') }} <br>
                                     Phone : {{ company_info()->phone }} <br>
                                     Email : {{ company_info()->email }} 
                                     {{-- {{$invoice->purchase}} --}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col text-right">
                                <br>
                                <b>Order No :</b> {{ $invoice->invoice_no }}<br>
                                <b>Order Date :</b> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d-M-Y') }}<br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl #</th>
                                        <th>Product List/Description</th>
                                        <th class="text-right">Price </th>
                                        <th class="text-right">Qty</th>
                                        <th class="text-right">Return Qty</th>
                                        <th class="text-right">SubTotal</th>
                                        @if($invoice->related_party_type=='Customer' && $invoice->total_amount >0)
                                            <th class="text-right">Commission</th>
                                            <th class="text-right">NetTotal</th>
                                        @endif
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $i=0;
                                            $total=0;
                                            $commission=0;
                                        @endphp
                                        {{--This Portion via Requisition Purchase Details --}}
                                        @if($invoice->related_party_type=='Supplier' && $invoice->total_amount >0)
                                            @foreach($invoice->purchase->quotation->quotationProduct as $product)
                                                @php $total+=($product->price*$product->qty); @endphp
                                                <tr>
                                                    <td> {{ ++$i }} </td>
                                                    <td> {{ $product->requisitionProduct->product->name."--". $product->requisitionProduct->product->unit->name }} </td>
                                                    <td class="text-right"> {{ $product->price }} </td>
                                                    <td class="text-right"> {{ $product->qty }}</td>
                                                    <td class="text-right"> {{ ($product->price*$product->qty) }}</td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <th colspan="4" class="text-right">Total Amount:</th>
                                                    <td class="text-right">{{ number_format($total,2) }}</td>
                                                </tr>
                                        @endif
                                        {{--This Portion For Purchase Accesories as Expense--}}
                                        @if($invoice->related_party_type==null && $invoice->cost_id==1)
                                            @foreach($invoice->products as $product)
                                                @php $total+=($product->price*$product->stock_in_qty); @endphp
                                                <tr>
                                                    <td> {{ ++$i }} </td>
                                                    <td> {{ $product->product->name."--". $product->product->unit->name }} </td>
                                                    <td class="text-right"> {{ $product->price }} </td>
                                                    <td class="text-right"> {{ $product->stock_in_qty }}</td>
                                                    <td class="text-right"> {{ ($product->price * $product->stock_in_qty) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="4" class="text-right">Total Amount:</th>
                                                <td class="text-right">{{ number_format($total,2) }}</td>
                                            </tr>
                                        @endif

                                        @if($invoice->related_party_type==null && $invoice->cost_id && $invoice->cost_id != 1)
                                          
                                              
                                                <tr>
                                                    <td> {{ ++$i }} </td>
                                                    <td> {{ $invoice->cost->name }} </td>
                                                    <td class="text-right"> {{ 0 }} </td>
                                                    <td class="text-right"> {{ 0 }}</td>
                                                    <td class="text-right"> {{ $total+=$invoice->total_amount }}</td>
                                                </tr>
                                           
                                            <tr>
                                                <th colspan="4" class="text-right">Total Amount:</th>
                                                <td class="text-right">{{ number_format($total,2) }}</td>
                                            </tr>
                                        @endif
                                        {{--This Portion For Sales--}}
                                        @if($invoice->related_party_type=='Customer' && $invoice->total_amount >0)
                                        @foreach($invoice->sales as $product)
                                           
                                            <tr>
                                                <td> {{ ++$i }} </td>
                                                <td> {{ $product->product->name."--".$product->product->unit->name }} </td>
                                                <td class="text-right"> {{ $product->price }} </td>
                                                <td class="text-right"> {{ $product->qty }}</td>
                                                <td class="text-right"> {{ $sale=($product->price*$product->qty) }}</td>
                                                @php
                                                    $dis=(($product->emp_commission*$product->qty)+($product->mar_commission*$product->qty));
                                                @endphp
                                                <td class="text-right"> {{ number_format($dis,2) }}</td>
                                                <td class="text-right">{{number_format(( $sale - $dis ),2)}}</td>
                                                @php $total+=($sale-$dis); @endphp
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <th colspan="6" class="text-right">Total Amount:</th>
                                                <td class="text-right">{{ number_format($total,2) }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-lg-9">
                                <h3 class="text-left">Note :</h3>
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                   {{ $invoice->note }}
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-lg-3">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="#" onclick="window.print()" class="btn btn-primary purchasePrint"><i class="fa fa-print"> Print</i></a>
            <a href="{{route('invoice.print',[$invoice->id,'edit=1'])}}" class="btn btn-primary purchasePrint"><i class="fa fa-edit"> Return</i></a>
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('style')
    <style>
        @media print {
            .purchasePrint {
                display: none;
            }
        }
    </style>
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


@stop
