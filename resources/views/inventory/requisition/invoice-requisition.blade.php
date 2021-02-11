@extends('layouts.fixed')

@section('title','Checking Purchase Requisition | Invoice')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Purchase Requisition View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Requisition</li>
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
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Requisition No : {{ $requisition->id }} , Requisition Invoice : {{ $requisition->invoice_no }}
                                    <small class="float-right"> Date: <label class="label-success" style="padding: 5px 15px"> {{ \Carbon\Carbon::parse($requisition->created_at)->format('D-d-M-Y')  }}</label> </small>
                                </h4>
                                <br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th> #SL</th>
                                            <th> Approval</th>
                                            <th>Product Type</th>
                                            <th>Group</th>
                                            <th>Item Name</th>
                                            <th>Item Code</th>
                                            <th> Unit </th>
                                            <th> Cur Stock</th>
                                            <th> 2 Monts Consum.</th>
                                            <th> present Req.Price</th>
                                            <th> present Req.Qty</th>
                                            <th>  Last Purchase</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    @php $i=0; @endphp
                                    @if($requisition->count()>0)
                                        {{ Form::open(['route'=>['inventory.requisition-item.checking-approval',$requisition->id],'method'=>'post']) }}

                                        @foreach($requisition->RequisitonProducts as $product)
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td> {{ Form::checkbox('product_id[]',$product->id,($product->user_id !=null ? true : false),['class'=>'form-control']) }} </td>
                                                <td>{{ $product->product->department ? $product->product->department->name : "N/A" }}</td>
                                                <td>{{ $product->product->group ? $product->product->group->name : " N/A " }}</td>
                                                <td>{{ $product->product ? $product->product->name  : " N/A " }}</td>
                                                <td>{{ $product->product ? $product->product->item_code : " N/A "  }}</td>
                                                <td>{{ $product->product->unit ? $product->product->unit->name : " N/A "  }}</td>
                                                <td> N/A</td>
                                                <td> N/A </td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->qty }}</td>
                                                <td> N/A </td>
                                                <td>{{ $product->note }}</td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-12">
                                {{ Form::textarea('checking_note',null,['class'=>'form-control','rows'=>5,'cols'=>5,'placeholder'=>'Approval Note....']) }}
                            </div>
                            <div class="col-lg-12">
                                <br>
                                {{ Form::submit('Approved Requisition Product / Item',['class'=>'btn btn-info']) }}
                            </div>


                        </div>

                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@stop