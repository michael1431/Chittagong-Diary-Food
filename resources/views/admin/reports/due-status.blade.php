@extends('layouts.fixed')
@section('title','Dues Status  - CDF ')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dues Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item active">Dues Report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!--.content-header-->

    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">
            <div class="row">
                {{--create/edit start --}}
                <div class="col-lg-12">
                    <div class=" bg-light">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Search Dues Report</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-lg-3">
                                        {{ Form::open(['route'=>'parties.status','method'=>'get','enctype'=>'multipart/form-data','id'=>'report_form']) }}
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    {{ Form::label('type','Choose Type: ',['class'=>'control-label'])}}
                                                    {{ Form::select('type',['Customer'=>'Customer','Supplier'=>'Supplier'],null,['class'=>'form-control ','placeholder'=>'Select Customer or Supplier','required','id'=>'type'])}}
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                        {{ Form::label('related_party','Select Customer / Supplier : ',['class'=>'control-label'])}}
                                                        <select id="related_party" name="related_party" class="form-control">

                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                        {{ Form::label("date","Date:",['class'=>'control-label']) }}
                                                        <div class="input-daterange input-group" id="datepicker">
                                                            {{ Form::text('start',old('start'),['class'=>'form-control','id'=>'start','placeholder'=>'From','required']) }}
                                                            <span class="input-group-addon">to</span>
                                                            {{ Form::text('end',old('end'),['class'=>'form-control','id'=>'end','placeholder'=>'To','required']) }}

                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button class="btn btn-info form-control" type="submit" id="show_report_customerSupplier">
                                                        Show Report
                                                    </button>
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                            <hr>
                                            @if(count($parties)>0)

                                            {{ Form::open(['route'=>'parties.changeDuesStatus','method'=>'post','enctype'=>'multipart/form-data','id'=>'report_form']) }}
                                            <fieldset>
                                                <legend style="border:solid 1px black;border-radius:10%">If You Want to  {{ $parties->first()->related_party_type=='Supplier'? 'Pay '.$parties->first()->supplier->name : 'Receive from '.$parties->first()->customer->name}}</legend>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                        {{ Form::label('amount', $parties->first()->related_party_type=='Supplier'? 'Pay Amount' : 'Receive Amount' ,['class'=>'control-label'])}}
                                                        {{Form::number('amount',0,['class'=>'form-control','required'=>'required'])}}

                                                        {{ Form::label('receive', $parties->first()->related_party_type=='Supplier'? 'Receive Amount' : 'Return Amount' ,['class'=>'control-label'])}}
                                                        {{Form::number('return',0,['class'=>'form-control','required'=>'required'])}}

                                                        @if ($errors->has('amount'))
                                                            <span class="help-block">
                                                                 <strong>{{ $errors->first('amount') }}</strong>
                                                            </span>
                                                        @endif

                                                        @if ($errors->has('return'))
                                                            <span class="help-block">
                                                                 <strong>{{ $errors->first('return') }}</strong>
                                                            </span>
                                                        @endif


                                                        {{ Form::label('amount','Note' ,['class'=>'control-label'])}}
                                                        {{Form::text('note',null,['class'=>'form-control'])}}
                                                        @if ($errors->has('note'))
                                                            <span class="help-block">
                                                                 <strong>{{ $errors->first('note') }}</strong>
                                                            </span>
                                                        @endif
                                                        {{Form::hidden('party_id',$parties->first()->related_party_id,['class'=>'form-control','required'=>'required'])}}
                                                        {{Form::hidden('party_type',$parties->first()->related_party_type,['class'=>'form-control','required'=>'required'])}}
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                        {{ Form::button($parties->first()->related_party_type=='Supplier'? 'Paid' : 'Submit',['type'=>'submit','id'=>'savekarat','class'=>'btn btn-primary']) }}
                                                </div>
                                            </div>
                                            </fieldset>
                                            {{ Form::close() }}
                                            @endif
                                    </div>
                                    <div class="col-lg-9 table-responsive" style="background: #ffffff;" id="print_portion">
                                            @if(count($parties)>0)
                                            <div class="panel">
                                                <div class="panel-heading" style="background: #fff">
                                                        <h1 class="text-center text-uppercase text-thin mar-no">{{ company_info()->company_name }}</h1>
                                                        <h1 class="h4 panel-title text-center">Ledger Statement</h1>
                                                <p class="text-center"><b>{{request('start') ? date('d-M-Y',strtotime(request('start'))):'--'}} To {{request('end') ? date('d-M-Y',strtotime(request('end'))):''}}</b></p>
                                                </div>
                                                <hr>
                                                <div class="panel-body">
                                            <caption class="align-center"><h3 class="text-center">{{ $parties->first()->related_party_type=='Supplier' ? $parties->first()->supplier->name : $parties->first()->customer->name }} 's Report</h3></caption>
                                            <table class="table table-bordered table-striped">



                                                <thead>
                                                <tr>
                                                    <th>sl</th>
                                                    <th>Invoice</th>
                                                    <th>Date</th>
                                                    <th>Event</th>
                                                    <th>Billed Amount</th>
                                                    <th>{{ $parties->first()->related_party_type=='Supplier'? 'Discount' : 'Commission' }}</th>
                                                    <th>{{ $parties->first()->related_party_type=='Supplier'? 'Paid' : 'Received' }}</th>
                                                    <th>{{ $parties->first()->related_party_type=='Supplier'? 'Paid' : 'Return' }}</th>
                                                    <th>Product Returned</th>
                                                    <th>{{ $parties->first()->related_party_type=='Supplier'? 'Payable' : 'Receivable' }}</th>
                                                </tr>
                                                </thead>
                                                <tbody id="dues_report">
                                                    @php
                                                        $continue=0;
                                                      
                                                    @endphp
                                                    @forelse($parties as $key=> $party)
                                                        <tr>
                                                        <td>{{ $key+1 }}</td>
                                                            <td>{{ $party->invoice_no }}</td>
                                                            <td>{{ date('d-m-Y',strtotime($party->created_at)) }}</td>
                                                            <td>{{ $party->event }}
                                                                @if($party->note)
                                                                    <br>[{{$party->note}}]
                                                                @endif
                                                            </td>
                                                            <td class="text-right">{{ number_format($party->total_amount,2)  }}</td>
                                                            <td class="text-right">{{ number_format($party->total_discount,2)  }}</td>
                                                            <td class="text-right">{{ number_format($party->total_paid,2)  }}</td>
                                                            @php

                                                              $return = $party->total_return

                                                            @endphp

                                                            <td class="text-right">{{ number_format($return,2) }}</td>


                                                            <td class="text-right">{{ number_format($party->total_less,2) }}</td>
                                                            
                                                             @php
                                                                if($party->total_return > 0){
                                                                   
                                                                    $continue = $continue+$party->total_return;
                                                                   
                                                              }else{
                                                                  // $continue +=($party->total_amount-$party->total_discount-$party->total_paid-$party->total_less)-$return;
                                                                    
                                                                    $continue+=($party->total_amount-$party->total_discount-$party->total_paid-$party->total_less);
                                                                }
                                                            @endphp
                                                
                                                            
                                                            <td class="text-right">{{ number_format($continue,2)  }}</td>

                                                        </tr>
                                                    @empty

                                                    @endforelse
                                                </tbody>
                                                <tr>
                                                <td colspan="9" class="text-right">Total</td>
                                                <td class="text-right">{{ number_format($continue,2) }}</td>
                                                </tr>
                                            </table>
                                            </div>
                                            @endif
                                    </div>
                                    <div class="text-right no-print" id="btn_print">
                                        <button class="btn btn-primary" onclick="printData()"><i class="fa fa-print"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--create/edit  start --}}



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

        $(document).ready(function(){
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#protable").DataTable();
            $("#related_party").select2({
                placeholder: 'Select Supllier or Customer'
            });
        });

        $('#type').change(function () {
            var type = $(this).val();

            $.ajax({
                method:"post",
                url:"{{ route('report.load_parties') }}",
                data:{type:type,_token:"{{csrf_token()}}"},
                success:function (response) {
                    $("#related_party").html(response);
                },
                error:function (err) {
                    console.log(err);
                }
            });
        });

        function printData() {
        $('#btn_print').hide();
        //$('#show_report_customerSupplier').hide();
        var contentPrint = document.getElementById('print_portion').innerHTML;
        var contentOrg = document.body.innerHTML;
        document.body.innerHTML = contentPrint;
        window.print();
        document.body.innerHTML = contentOrg;
        $('#btn_print').show();
        //$('#show_report_customerSupplier').show();
    }



    </script>
@stop
