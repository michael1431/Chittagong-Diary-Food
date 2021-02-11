@extends('layouts.fixed')

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
            {{ Form::open(['route'=>'inventory.purchase.store','method'=>'post','id'=>'PurchaseForm','class'=>'form-horizontal  ']) }}
            <div class="row">

                <div class="col-lg-4">
                    <div class="form-group {{   $errors->has('qty') ? 'has-error' : '' }} ">
                        {{ Form::label('','LC NO : ') }}
                        {{ Form::text('lc_no',null,['class'=>'form-control','placeholder'=>"LC302"]) }}
            
                        @if($errors->has('qty'))
                            <span class="">
                                <strong>{{ $errors->get('lc_no') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('','Requisition Number') }}
                        <select name="requisition_id" class="form-control invoice_requisition_id">
                            <option value="0">Select Requisition Number</option>
                            @foreach($requisitions as $requisition)
                                <option value="{{$requisition->id}}"> {{ $requisition->id." -- ".$requisition->invoice_no }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {{ Form::label('','Quotation\'s') }}
                        <select name="quotation_id" class="form-control invoice_quotation_id">
                            <option value="0">Select Party Quotation</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-8">
                    {{ Form::label('','Purchase Confirmation Note : ') }}
                    {{ Form::textarea('note',null,['class'=>'form-control','rows'=>5,'cols'=>5,'placeholder'=>'Purchase order confirmation note......']) }}
                </div>

                <div class="col-lg-3">
                    {{ Form::submit('Confirm Purchase Order',['class'=>'form-control btn btn-info']) }}
                </div>

            </div><!-- /.row -->
            {{ Form::close() }}
        </div><!-- /.container-fluid -->
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
@stop

@section('script')
    <!-- page script -->
    <script type="text/javascript">

        $(document).on('change','.invoice_requisition_id',function () {
            var requisition_id = $(this).val();

            $.ajax({
                method:"post",
                url:"{{ route('inventory.ajax-quotation-list') }}",
                data:{requisition_id:requisition_id,_token:"{{ csrf_token() }}"},
                dataType:"html",
                success:function (response) {
                    $('.invoice_quotation_id').html(response);
                }
            });
        });

        $("#PurchaseForm").submit(function (e) {
            e.preventDefault();
                $.ajax({
                    method:"post",
                    url:"{{ route('inventory.purchase.store') }}",
                    data: $(this).serialize(),
                    dataType:"json",
                    success:function (response) {
                        if (response.success == 1){
                            $.notify("Purchase order Successfully complete", {globalPosition: 'top center',className: 'success'});
                            $('.invoice_quotation_id').html('');

                        }
                        $(this).reset();
                    }
                });
        });

    </script>

@stop
