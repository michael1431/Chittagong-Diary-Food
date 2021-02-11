@extends('layouts.fixed')

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
                    <h1>Quotation taken for  Requisition No : {{ $requisition->id }} </h1>
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
                            <div class="row">
                                @php $loop = $quotations->count();$i=1; $count = 0; @endphp
                                @foreach($quotations as $key=>$quotation)
                                    {{--{{ dd($quotation) }}--}}
                                    <div class="col-lg-6">
                                        <h4 class="bg-info" style="padding: 5px 10px;"> {{ $quotation[$count]->supplier->name }} -- {{ $quotation[$count]->supplier->phone }} </h4>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Supplier</th>
                                                <th>Item Name</th>
                                                <th>Item Code</th>
                                                <th>Item Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($count < count($quotation))
                                                @php $sl=0; @endphp
                                                @foreach(\App\QuotationProduct::where('requisition_id',$requisition->id)
                                                ->where('supplier_id',$quotation[$count]->supplier_id)
                                                ->get()
                                                as $product)
                                                    <tr>
                                                        <td> {{ ++$sl }} </td>
                                                        <td> {{ $product->supplier->name }} </td>
                                                        <td> {{ $product->requisitionProduct->product->name }} </td>
                                                        <td> {{ $product->requisitionProduct->product->item_code }} </td>
                                                        <td> {{ $product->price }} &nbsp; Tk </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @php $count++ @endphp
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
