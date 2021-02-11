@extends('layouts.fixed')

@section('title','Manage Order -CDF')
@section('style')
    <style>
        .check_label{
            padding: 5px;
        }
    </style>
@stop

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
                    <h1>All Order </h1>
                    
                <p>
                    @if(request('order_history'))
                    <a class="btn btn-xs btn-info" href="{{route('view-order')}}">View Pending Order</a>
                    @else
                    <a class="btn btn-xs btn-info" href="{{route('view-order',['order_history=1'])}}">View Order History</a>
                    @endif
                    
                </p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order List</li>
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
                        <center><caption><h2>Order List</h2></caption></center>
                            <table class="table-bordered table-striped table">
                                <thead>
                                    <th>#SL</th>
                                    <th>Order No</th>
                                    <th>Total Amount</th>
                                    <th>OrderBy</th>
                                    @if(request('order_history'))
                                    <th>SoldBy</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @php $i=0; @endphp
                                    @if($invoices->count()>0)
                                        @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td width="11%">{{ $invoice->invoice_no }}</td>
                                                <td>{{ $invoice->total_amount }}</td>
                                                <td>{{ $invoice->related_party_type=='Customer' ? $invoice->order_by->name : '' }}</td>
                                                @if(request('order_history'))
                                                    <td>{{ $invoice->user->name }}</td>
                                                @endif
                                                <td>
                                                    @if($invoice->status==0)
                                                        <label class='label label-danger check_label'>Pending</label> 
                                                    @else 
                                                    <a href="{{ route('invoice.print',[$invoice->id,'chalan'=>1]) }}">
                                                        <label class='label label-success check_label'> Delivered </label>
                                                    @endif
                                                </td>
                                                <td> 
                                                    {{ \Carbon\Carbon::parse($invoice->created_at)->format('D-d-M-Y')   }}  -- {{ $invoice->created_at->diffForHumans() }}
                                                </td>
                                                <td>
                                                    <a class=" {{ $invoice->status ==0 ? "fa fa-eye btn btn-danger" : "fa fa-eye  btn btn-success" }}" href="{{ $invoice->status ==0 ? route('invoice-show',$invoice->id) : route('invoice.print',$invoice->id) }}"></a>
                                                    @if($invoice->status)
                                                        <a class="far fa-minus-circle btn btn-info" href="{{ route('invoice-return',$invoice->id) }}"></a>
                                                    @endif
                                                </td>
                                            </tr>
                                       @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{$invoices->appends(request()->input())->render()}}
                        </div>
                        {{-- requisition  lists End --}}

                    </div>
                </div>
            </div>
        </div>
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

    <!-- page script -->
    <script type="text/javascript">

    </script>
@stop
