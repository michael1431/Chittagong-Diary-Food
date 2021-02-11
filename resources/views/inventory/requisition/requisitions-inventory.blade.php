@extends('layouts.fixed')

@section('title','Manage Requisition - Purcahse Requisition')
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
                    <h1>All Requisitions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Requisition</li>
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

                            <table class="table-bordered table-striped table">
                                <thead>
                                    <th>#SL</th>
                                    <th>Requisition No</th>
                                    <th>R. Invoice No</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Note</th>
                                    <th>R. Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @php $i=0; @endphp
                                    @if($requisitions->count()>0)
                                        @foreach($requisitions as $requisition)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td width="11%">{{ $requisition->id }}</td>
                                                <td>{{ $requisition->invoice_no }}</td>
                                                <td>{{ $requisition->price }}</td>
                                                <td>{{ $requisition->qty }}</td>
                                                <td>{{ $requisition->note }}</td>
                                                <td> {{ \Carbon\Carbon::parse($requisition->created_at)->format('D-d-M-Y')   }}  -- {{ $requisition->created_at->diffForHumans() }}</td>
                                                <td>

                                                    {!! \App\RequisitionProduct::where('requisition_id',$requisition->id)->whereNotNull('user_id')->get()->count()>0 ? "<label class='label label-success check_label'> Checked </label>" : "<label class='label label-danger check_label'>Not Checked</label>" !!}
                                                </td>
                                                <td>
                                                    <a class=" {{ $requisition->status !=null ? "fa fa-eye btn btn-danger" : "fa fa-eye  btn btn-success" }}" href="{{ $requisition->status !=null ? "#" : route('inventory.purchase-requisition.single',$requisition->id) }}"></a> </td>
                                            </tr>
                                       @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{-- requisition  lists End --}}

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
