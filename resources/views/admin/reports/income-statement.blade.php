@extends('layouts.fixed')
@section('title','Income Statement  - CDF ')
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
                                            <div class="col-sm-12" id="print_portion">
                                                <div class="panel">
                                                    <div class="panel-heading" style="background: #fff">
                                                            <h1 class="text-center text-uppercase text-thin mar-no text-primary">{{ company_info()->company_name }}</h1>
                                                            <h1 class="h4 panel-title text-center">Income Statement</h1>
                                                            <p class="text-center"><b> At The End of {{ date('d-M-Y')}} </b></p>
                                                    </div>
                                                    <hr>
                                                    <div class="panel-body">
                                                        <div class="row">
                        
                                                            
                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                               
                                                                <table class="table table-bordered table-striped">
                        
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Account Title</th>
                                                                            <th>Notes</th>
                                                                            <th>Amount</th>
                                                                            <th>Amount</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th><u>Sales Revenue:</u></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ 'Sales'}}
                                                                            </td>
                                                                            <th></th>
                                                                            <th class="text-right">{{ $saleAmount }}</th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>&nbsp;&nbsp;&nbsp;&nbspLess:Sales Return & allowances:</th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ 'Sales Return' }}
                                                                            </td>
                                                                            <td class="text-right">{{ $salesReturn }}</td>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ 'Discount on Sales' }}:
                                                                            </td>
                                                                            <td class="text-right" style="border-bottom: black 2px solid;">
                                                                                {{ $discountOnSale }}</td>
                                                                                <td  class="text-right" style="border-bottom: black 2px solid;">
                                                                                    {{$saleAllowence=($discountOnSale+$salesReturn)}}
                                                                                </td>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-right">Net Sales</th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th class="text-right">{{$netSale=$saleAmount-$saleAllowence}}</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><u>Less: Cost of Goods Sold(COGS)</u></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Beginning Inventory</td>
                                                                            <th></th>
                                                                            <td class="text-right">{{$bInventory=0}}</td>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ 'Purchases' }}
                                                                            </td>
                                                                            <th class="text-right">{{ $purchaseAmount }}</th>
                                                                            <td></td>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;Less:Purchase Return & allowances:</th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ 'Purchase Return' }}:
                                                                            </td>
                                                                            <td class="text-right">({{ $purchaseReturn }})</td>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ 'Discount on Purchase' }}
                                                                                :</td>
                                                                            <td style="border-bottom: black 2px solid;" class="text-right">({{ $discountOnPurchase }})</td>
                                                                            <td></td>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-right">Net Purchases</th>
                                                                            <th></th>
                        
                                                                            <th class="text-right">{{$netPurchase=$purchaseAmount-($purchaseReturn+$discountOnPurchase)}}
                                                                            </th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Ending Inventory</td>
                                                                            <th></th>
                                                                            <td class="text-right" style="border-bottom: black 2px solid;">
                                                                                ({{ $eInventory }})</td>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Cost of Goods Sold</td>
                                                                            <th></th>
                                                                            <td></td>
                                                                            <td class="text-right" style="border-bottom: black 2px solid;">
                                                                                ({{ $cogs=($bInventory+$netPurchase-$eInventory)}})</td>
                        
                                                                        </tr>
                                                                        <tr class="table-info">
                                                                                @php
                                                                                $grossProfit=$netSale-$cogs;
                                                                                @endphp
                                                                            <th><u>Gross {{ $grossProfit>0 ? 'Income:':'Loss :' }}</u></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th class="text-right">
                                                                                {{number_format($grossProfit,2)}}</th>
                                                                        </tr>
                                                                        {{-- operating Expenses --}}
                                                                        <tr>
                                                                            <th><u>Less:Operating Expenses:</u></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        @php $sumAmount=0; @endphp
                                                                        @forelse ($operatingExp as $opEx)
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$opEx['account_head']}}</td>
                                                                            <td></td>
                                                                            @php $sumAmount+=$opEx['amount']; @endphp
                                                                            <td class="text-right">{{$opEx['amount']}}</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        @empty
                        
                                                                        @endforelse
                                                                        <tr>
                                                                            <td>Total Operating Expenses</td>
                                                                            <th></th>
                                                                            <td style="border-top: black 2px solid;"></td>
                                                                            <td class="text-right" style="border-bottom: black 2px solid;">({{$sumAmount}})</td>
                        
                                                                        </tr>
                                                                        <tr class="table-info">
                                                                            <th><u>Net {{ ($grossProfit-$sumAmount)>0 ? 'Income ':'Loss ' }} :</u></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th class="text-right">{{number_format(($grossProfit-$sumAmount),2)}}</th>
                                                                        </tr>
                                                                    </tbody>
                                                                    
                                                                </table>
                                                               
                                                               
                                                                
                                                            </div>
                                                        </div>
                        
                                                    </div>
                                                    <div class="panel-footer">
                                                                <div class="text-right no-print">
                                                                    <button class="btn btn-primary" onclick="printData()"><i class="fa fa-print"></i></button>
                                                                </div>
                                                    </div>
                                                </div>
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

    $(document).ready(function () {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });

    function printData() {
        $('#btn_print').hide();
        $('#show_report_customerSupplier').hide();
        var contentPrint = document.getElementById('print_portion').innerHTML;
        var contentOrg = document.body.innerHTML;
        document.body.innerHTML = contentPrint;
        window.print();
        document.body.innerHTML = contentOrg;
        $('#btn_print').show();
        $('#show_report_customerSupplier').show();
    }


    </script>
@stop
