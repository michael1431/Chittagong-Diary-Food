@extends('layouts.fixed')

@section('title','Requisition Inventory')

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
                    <h1>Manage Requisition</h1>
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
                        <div class="col-lg-12 table-responsive">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <td> #SL</td>
                                            <td> Invoice No</td>
                                            <td> LC No</td>
                                            <td> Requisition No</td>
                                            <td> Supplier / Party</td>
                                            <td> Quotation No </td>
                                            <td> Authorized By</td>
                                            <td> Date & Time</td>
                                            <td> Ordered Duration </td>
                                            <td> Action </td>
                                        </tr>
                                    </thead>

                                    <tbody class="bodyItem" id="requisition_items">
                                    @php $i= 0; @endphp
                                    @if($purchases->count()>0)
                                        @foreach($purchases as $purchase)
                                            <tr>
                                                <td> {{ ++$i }} </td>
                                                <td> {{ $purchase->invoice_no }} </td>
                                                <td> {{ $purchase->invoice ? $purchase->invoice->lc_no :'' }} </td>
                                                <td> {{ $purchase->requisition_id }} </td>
                                                <td>
                                                    <label class="btn btn-dark btn-block">
                                                        {{ $purchase->quotation->supplier->name ." -- ".$purchase->quotation->supplier->phone }}
                                                    </label>
                                                </td>
                                                <td> {{ $purchase->quotation_id }} </td>
                                                <td> <label class="btn btn-primary btn-block"> {{  $purchase->user->name }} </label> </td>
                                                <td> {{ \Carbon\Carbon::parse($purchase->created_at)->format('d-M-Y -- h:i:s A') }} </td>
                                                <td> {{ $purchase->created_at->diffForHumans() }} </td>
                                                <td> <a href="{{ route('inventory.purchase.print',$purchase->id) }}" target="_blank" class="btn btn-info">Print</a> </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="12" class=" bg-danger text-center"> No Requisition Product found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                                <br>
                                <br>
                                <br>

                            </div>
                        </div>
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
@stop

@section('script')
    <!-- page script -->
    <script type="text/javascript">

        $(document).ready(function () {
            window.setTimeout(function() {
                $(".alert").slideUp(1000, function(){
                    $(this).remove();
                });
            }, 1200);

        });
    </script>

@stop
