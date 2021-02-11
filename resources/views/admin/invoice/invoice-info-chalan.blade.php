@extends('layouts.master')

@section('title','Report -CDF')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Delivery Chalan Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Delivery Chalan</li>
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
                                    <i class="fas fa-globe"></i>Delivery Chalan
                                    <small class="float-right">Date: {{ \Carbon\Carbon::now()->format('Y/m/d')}}</small>
                                </h4> 
                            </div>
							<div class="col-12">
                                <h3>
									<center><strong>{{ company_info()->company_name }}</strong></center>
                                </h3> 
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Bill For
                                @if($invoice->related_party_type=='Customer')
                                <address>
                                   @if($invoice->subDistributor)
                                    <strong> {{ $invoice->subDistributor->name }} </strong><br>
                                    Address : {{ $invoice->subDistributor->address }}
                                    <br> Phone:  {{ $invoice->subDistributor->phone }}
                                    @else
                                    <strong> {{ $invoice->customer->name }} </strong><br>
                                    Address : {{ $invoice->customer->address }}
                                    <br> Phone:  {{ $invoice->customer->phone1 }},{{ $invoice->customer->phone2 }}
                                    @endif
                                </address>
                                @endif
                            </div> 
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <address class="text-center">
								{{--<strong>{{ company_info()->company_name }}</strong>--}}
								{{ str_before(company_info()->address,'|') }}
									<br>
                                    {{ str_after(company_info()->address,'|') }} <br>
                                     Phone : {{ company_info()->phone }} <br>
                                     Email : {{ company_info()->email }} 
                                     {{-- {{$invoice->purchase}} --}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col text-right">
                                <br>
                                <b>Delivery Chalan No :</b> {{ $invoice->invoice_no }}<br>
                                <b>Date :</b> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d-M-Y') }}<br>
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
                                        <th>Description</th>
                                        <th class="text-right">Qty</th>                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $i=0;
                                            $qty=0;
                                          
                                        @endphp
                                       
                                        @if($invoice->related_party_type=='Customer' && $invoice->total_amount >0)
                                        @foreach($invoice->sales as $product)
                                           
                                            <tr>
                                                <td> {{ ++$i }} </td>
                                                <td> {{ $product->product->name."--".$product->product->unit->name }} </td>
                                                <td class="text-right"> {{ $product->qty }}</td>
                                            </tr>
                                            @php
                                                $qty+=$product->qty;
                                            @endphp
                                        @endforeach
                                            <tr>
                                                <th colspan="2" class="text-right">Total Quantity:</th>
                                                <td class="text-right">{{ $qty }}</td>
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
								<h6><span class="badge badge-info">Client Copy</span></h6>
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
                <!-- /.col -->
                    <!-- Main content -->
					<hr>
                    <div class="col-12" style="margin-top:20px">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i>Delivery Chalan
                                    <small class="float-right">Date: {{ \Carbon\Carbon::now()->format('Y/m/d')}}</small>
                                </h4> 
                            </div>
							<div class="col-12">
                                <h3>
									<center><strong>{{ company_info()->company_name }}</strong></center>
                                </h3> 
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Bill For
                                @if($invoice->related_party_type=='Customer')
                                <address>
                                   @if($invoice->subDistributor)
                                    <strong> {{ $invoice->subDistributor->name }} </strong><br>
                                    Address : {{ $invoice->subDistributor->address }}
                                    <br> Phone:  {{ $invoice->subDistributor->phone }}
                                    @else
                                    <strong> {{ $invoice->customer->name }} </strong><br>
                                    Address : {{ $invoice->customer->address }}
                                    <br> Phone:  {{ $invoice->customer->phone1 }},{{ $invoice->customer->phone2 }}
                                    @endif
                                </address>
                                @endif
                            </div> 
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <address class="text-center">
								{{--<strong>{{ company_info()->company_name }}</strong>--}}
								{{ str_before(company_info()->address,'|') }}
									<br>
                                    {{ str_after(company_info()->address,'|') }} <br>
                                     Phone : {{ company_info()->phone }} <br>
                                     Email : {{ company_info()->email }} 
                                     {{-- {{$invoice->purchase}} --}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col text-right">
                                <br>
                                <b>Delivery Chalan No :</b> {{ $invoice->invoice_no }}<br>
                                <b>Date :</b> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d-M-Y') }}<br>
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
                                    <th>Description</th>
                                    <th class="text-right">Qty</th>                                       
                                </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i=0;
                                        $qty=0;
                                      
                                    @endphp
                                   
                                    @if($invoice->related_party_type=='Customer' && $invoice->total_amount >0)
                                    @foreach($invoice->sales as $product)
                                       
                                        <tr>
                                            <td> {{ ++$i }} </td>
                                            <td> {{ $product->product->name."--".$product->product->unit->name }} </td>
                                            <td class="text-right"> {{ $product->qty }}</td>
                                        </tr>
                                        @php
                                            $qty+=$product->qty;
                                        @endphp
                                    @endforeach
                                        <tr>
                                            <th colspan="2" class="text-right">Total Quantity:</th>
                                            <td class="text-right">{{ $qty }}</td>
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
								<h6><span class="badge badge-info">Office Copy</span></h6>
                            </div>
                            <!-- /.col -->
                            <div class="col-lg-3">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="#" onclick="window.print()" class="btn btn-primary purchasePrint pull-right"><i class="fa fa-print"> Print</i></a>
            {{-- <a href="{{route('invoice.print',[$invoice->id,'edit=1'])}}" class="btn btn-primary purchasePrint"><i class="fa fa-edit"> Return</i></a> --}}
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
