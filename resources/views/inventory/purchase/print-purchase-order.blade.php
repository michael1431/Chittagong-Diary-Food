@extends('layouts.master')

@section('title','Requisition Inventory')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Purchase Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
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
                                    <i class="fas fa-globe"></i> {{ $purchase->quotation->supplier->name  }}
                                    <small class="float-right">Date: {{ \Carbon\Carbon::now()->format('Y/m/d')}}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong> {{ $purchase->quotation->supplier->name }} </strong><br>
                                    Address : {{ $purchase->quotation->supplier->address }}
                                    <br> Phone:  {{ $purchase->quotation->supplier->phone }}<br>
                                    Email: N / A
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                        <strong>{{ company_info()->company_name }}</strong><br>
                                        {{ str_before(company_info()->address,'|') }} <br>
                                         Phone : {{ company_info()->phone }} <br>
                                         Email : {{ company_info()->email }} 
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                               {{-- <b>Invoice #007612</b><br>--}}
                                <br>
                                <b>Order No :</b> {{ $purchase->id }}<br>
                                <b>Order Date :</b> {{ \Carbon\Carbon::parse($purchase->created_at)->format('d-M-Y') }}<br>
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
                                        <th>Serial #</th>
                                        <th>Item Code</th>
                                        <th>Product / Item Name</th>
                                        <th>Unit </th>
                                        <th>Price </th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0; $total=0; @endphp
                                        @foreach($purchase->quotation->quotationProduct as $product)
                                            @php $total+=($product->price * $product->qty); @endphp


                                            <tr>
                                                <td> {{ ++$i }} </td>
                                                <td> {{ $product->requisitionProduct->product->item_code }} </td>
                                                <td> {{ $product->requisitionProduct->product->name }} </td>
                                                <td> {{ $product->requisitionProduct->product->unit->name }} </td>
                                                <td> {{ $product->price }} Tk</td>
                                                <td> {{ $product->qty }}</td>
                                                <td> {{ ($product->price * $product->qty) }} Tk</td>
                                            </tr>
                                        @endforeach
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
                                   {{ $purchase->note }}
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-lg-3">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>

                                            <th>Total:</th>
                                            <td>{{ $total }} TK</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="#" onclick="window.print()" class="btn btn-primary purchasePrint fas fa-print fa">Print Purchase Order</a>
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
