@extends('layouts.master')

@section('title','Manage Requisition - Purcahse Requisition')

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
                    <h1>Comparative Statement according to Quotation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Quotation Taken Lists</li>
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

                                {{-- Group By Quotation start --}}
                                <h4 class="text-left">Purchase Requisition : {{ $requisition->id }} <p style="margin: 0" class="pull-right"> Date : {{ \Carbon\Carbon::parse($requisition->created_at)->format('d-m-Y')}} </p>  </h4>
                                <br>
                                <table class="table-bordered table-striped table">
                                    <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Item Code </th>
                                        <th>Item Name </th>
                                        @foreach($suppliers as $sup=>$supplier)

                                            <th> {{ $supplier[0]->supplier->name }}  </th>
                                         @endforeach
                                        <th>Quotation Generate By</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php $i =0; $count = 0; @endphp

                                            @foreach($products as $key=>$cs)

                                            <tr>
                                            @if($count == 0)
                                               <td>{{ ++$i }}</td>
                                               <td>{{ $cs[$count]->requisitionProduct->product->item_code }}</td>
                                               <td>{{ $cs[$count]->requisitionProduct->product->name }}</td>

                                               @foreach($suppliers as $sup=>$supplier)
                                                   @php
                                                        $pricing = \App\QuotationProduct::where('requisition_id',$requisition->id)->where('supplier_id',$supplier[0]->supplier_id)->where('requisition_product_id',$cs[$count]->requisition_product_id)->orderBy('price')->get();
                                                   @endphp

                                                   {{-- product pricing show according to supplier start --}}
                                                    @foreach($pricing as $price)
                                                        <td> {{ $price->price }} TK </td>
                                                    @endforeach
                                                   {{-- product pricing show according to supplier End --}}
                                                    @endforeach
                                                    <td>  {{ $cs[$count]->user->name }} </td>
                                            @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- Group By Quotation End --}}

                        </div>
                    </div>
                    <button class="btn-primary btn cs" type="button" onclick="window.print()"> <i class="fa fa-print"></i> Print Comparative Statement</button>
                </div>

            </div>

        </div>
    </section>
@stop

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        @media print {
            .cs {
                display: none;
            }
        }
    </style>

@stop

@section('plugin')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- page script -->
    <script type="text/javascript">

    </script>
@stop
