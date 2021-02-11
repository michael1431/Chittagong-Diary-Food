@extends('layouts.fixed')
@section('title','Dues Status  - CDF ')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dues Report </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item active">Dues Report </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">
            <div class="row">
                {{--create/edit start --}}
                <div class="col-lg-12">
                    <div class=" bg-light">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Search Dues Report </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                                        {{ Form::open(['route'=>'income_expense.status','method'=>'get','enctype'=>'multipart/form-data','id'=>'report_form']) }}

                                        <!--  PRODUCT NAME  -->


                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" style="float: left;">
                                            {{-- <span style="display: block;height: 10px;width: 100%;background: #fff;"></span> --}}
                                            <a href="{{ route('income_expense.status',['daily=1']) }}" class="btn btn-info">Todays Report</a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" style="float: left;">
                                            {{-- <span style="display: block;height: 10px;width: 100%;background: #fff;"></span> --}}
                                            <a href="{{ route('income_expense.status',['weekly=1']) }}" class="btn btn-info text-light">Last Week's Report</a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" style="float: left;">
                                            {{-- <span style="display: block;height: 10px;width: 100%;background: #fff;"></span> --}}
                                            <a href="{{ route('income_expense.status',['monthly=1']) }}"
                                                class="btn btn-info ">last Month's Report</a>
                                        </div>

                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" style="float: left;">
                                            {{-- <span style="display: block;height: 10px;width: 100%;background: #fff;"></span> --}}
                                            <div id="demo-dp-range">
                                                {{-- {{ Form::label("em","Query Date:",['class'=>'label-control']) }}
                                                --}}
                                                <div class="input-daterange input-group" id="datepicker">
                                                    {{ Form::text('start',old('start'),['class'=>'form-control','id'=>'start','placeholder'=>'From','required']) }}
                                                    <span class="input-group-addon">to</span>
                                                    {{ Form::text('end',old('end'),['class'=>'form-control','id'=>'end','placeholder'=>'To','required']) }}

                                                </div>
                                                <button class="btn btn-info form-control" type="submit"
                                                    id="show_report_customerSupplier">
                                                    Show Report
                                                </button>
                                            </div>
                                        </div>
                                        <!-- / PRODUCT NAME  -->
                                        {{ Form::close() }}
                                    </div>


                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <h2 class="text-center">Date-Wise Income Report </h2>
                                        <table class="table table-bordered" id="protable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">sl</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">TotalSales</th>
                                                    <th class="text-center">CostOfGoods</th>
                                                    <th class="text-center">GrossProfit</th>
                                                    <th class="text-center">Expenses</th>
                                                    <th class="text-center">NetProfit</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dues_report">
                                                @php
                                                    $sales_total=0;
                                                    $cogs_total=0;
                                                    $total_exp=0;
                                                    $profit=0;
                                                    $i=0;
                                                @endphp
                                                @forelse($dateGroups as $key=> $value)
                                                @php
                                                $purchase_total=0;
                                                $gross_sales=0;
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $i+1 }}</td>
                                                    <td class="text-center"><strong>{{ $key }}</strong></td>
                                                    @php
                                                        if($sales->has($key)){
                                                            foreach($sales[$key] as $sale_detail){
                                                            foreach($sale_detail->product->stocks as $stocks_datails){
                                                            $purchase_rate=$stocks_datails->price;
                                                            }
                                                            $purchase_total+= ($sale_detail->qty * $purchase_rate);
                                                            $gross_sales+=($sale_detail->qty * $sale_detail->price);
                                                            }
                                                        }
                                                    @endphp
                                                    <td class="text-right">{{ $gross_sales }}</td>
                                                    
                                                    <td class="text-right">{{ $purchase_total }}</td>
                                                    <td class="text-right">
                                                        {{ $balance=$gross_sales - $purchase_total }}</td>
                                                    <td class="text-right">
                                                        {{ $exp=$expenses->has($key) ? $expenses[$key]->sum('total_paid'): 0 }}
                                                    </td>
                                                    @php
                                                    $sales_total+=$gross_sales;
                                                    $cogs_total+=$purchase_total;
                                                    $profit+=($balance-$exp);
                                                    $total_exp+=$exp;
                                                    $i++;
                                                    @endphp
                                                    <td class="text-right">{{ $balance-$exp }}</td>

                                                </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-right">Total</th>
                                                    <th class="text-right" style="border-top:#000 solid 2px;">
                                                        {{ $sales_total }}</th>
                                                    <th class="text-right" style="border-top:#000 solid 2px;">
                                                        {{ $cogs_total }}</th>
                                                    <th class="text-right" style="border-top:#000 solid 2px;">
                                                        {{ $sales_total-$cogs_total }}</th>
                                                    <th class="text-right" style="border-top:#000 solid 2px;">
                                                        {{ $total_exp }}</th>
                                                    <th class="text-right" style="border-top:#000 solid 2px;">
                                                        <strong>{{ $profit }}</strong></th>
                                                </tr>
                                            </tfoot>

                                        </table>



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


    </script>
@stop
