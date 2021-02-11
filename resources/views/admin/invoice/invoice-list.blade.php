@extends('layouts.fixed')

@section('title','Invoice list -CDF')
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
                    <h1>All Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice List</li>
                    </ol>
                    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">
                        Edit Invoice Date
                      </button>
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

                            <table class="table-bordered table-striped table">
                                <thead>
                                    <th>#SL</th>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>Party</th>
                                    <th>Event</th>
                                    <th>Total</th>                                    
                                    <th>Commission</th>                                   
                                    <th>Paid/Received</th>
                                    <th>Action</th>
                                </thead>

                               
                                <tbody>
                                    @php 
                                        $i=0;
                                        $total=0;
                                    @endphp
                                    @foreach($invoices as $invoice_info)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ date('d-m-Y',strtotime($invoice_info->created_at)) }}</td>
                                            <td>{{ $invoice_info->invoice_no }}</td>
                                            
                                            @if($invoice_info->related_party_type !== null && $invoice_info->related_party_type == 'Customer')
                                                <td><strong class="badge badge-success"> Customer </strong>  {{ $invoice_info->order_by->name ?? 'N/A' }}</td>
                                              
                                            @elseif($invoice_info->related_party_type !== null && $invoice_info->related_party_type == 'Supplier')
                                                <td><strong class="badge badge-info"> Supplier </strong>   {{ $invoice_info->supplier->name ?? 'N/A' }}</td>

                                            @elseif($invoice_info->related_party_type !== null && $invoice_info->related_party_type == 'Employee')
                                                <td><strong class="badge badge-warning"> Employee </strong>   {{ $invoice_info->employee->name ?? 'N/A' }}</td>
                                    
                                            @else
                                                <td>
                                                    <strong class="badge badge-danger"> Expenses </strong>
                                                    {{ $invoice_info->cost->name ?? 'N/A' }}
                                                   
                                                </td>
                                            @endif
                                            
                                            <td>{{ strtoupper($invoice_info->event) }}</td>
                                            <td>{{ $invoice_info->total_amount }}</td>
                                            <td>{{ $invoice_info->total_discount }}</td>
                                            {{-- <td>{{ $invoice_info->total_less }}</td> --}}
                                            <td>{{ $invoice_info->total_paid }}</td>
                                            {{-- <td>{{ $invoice_info->created_at}}</td> --}}
                                            <td>
                                                    <a href="{{ route('invoice.print',$invoice_info->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                    {{-- <a href="{{ url('SaleManagement/sale-invoice/'.$invoice_info->id) }}" target="_blank" class="btn btn-primary fa fa-print"> Double</a>
                                                    <a href="{{ url('Reports/Invoice-Delete/'.$invoice_info->id) }}" class="btn btn-danger fa fa-trash">  Delete</a> --}}

                                            </td>
                                        </tr>
                                    @endforeach
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
    <!-- /.content -->
 <!-- The Modal -->
 <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Invoice Date</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <form method="POST" action="{{route('lc.reportFind')}}"
                accept-charset="UTF-8" class="form-horizontal">
        <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="label-control">Set Date </label>
                            <input class="form-control" name="created_at" type="datetime" placeholder="YYYY-MM-DD">
                            <input type="hidden" name="invoice_edit" value="1">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="label-control">Item Unit</label>
                            <select class="form-control select2-hidden-accessible" name="invoice_id[]" tabindex="-1"
                                aria-hidden="true" multiple>
                                @forelse ($invoice_options as $item)
                                    
                                <option value="{{$item->id}}">{{$item->id}}  {{$item->invoice_no}}</option>
                                @empty
                                    
                                @endforelse
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        
                    </div>
                </div>
          
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
         
          <div class="form-group row text-right">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-success">Update</button>
            </div>
        </div>
        </div>
    </form>
  
      </div>
    </div>
  </div>


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
