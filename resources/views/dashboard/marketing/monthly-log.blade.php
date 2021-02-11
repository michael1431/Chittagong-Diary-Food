@extends('dashboard.marketing.employee')

@section('title','Employee Dashboard')

@section('content')

<!-- Main content -->

<!-- /.content-header -->

{{--start searching individual ledger report --}}
<section class="content no-print">
    <div class="container-fluid">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            @if($errors->any())
            <div class="col-md-12 alert alert-danger emptyMsg">
                <h6>{{$errors->first(1)}}</h6>
            </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

               


                </div>
            </div>
           
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card-body">
            {{-- start showin gsuccess message --}}
            <div class="col-md-4">
                @if (session('success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
                @endif
            </div>
            
           
            <div class="row">
                <div class="col-lg-12">
                    <div class=" bg-light">
                        

                            <div class="card-body" style="display: block;">
                                <div class="box-header with-border text-center" style="margin-bottom: -25px!important;">
                                    <h3>{{ company_info()->company_name }}</h3>
                                    <p> {{ str_before(company_info()->address,'|') }}</p>
                                    {{-- <small>{{ company_info()->phone}}</small> --}}


                                    <h3>{{ Auth::user()->name }}</h3>
                                    {{-- <p>1-OCT-2018 to 30-Sep-2019</p> --}}
                                </div>

                                <table class="table table-striped display" id="myTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="date_column">Date</th>
                                            <th>Invoice. No</th>
                                            <th class="pr">Particulars</th>
                                            <th class="text-right">Amount</th>
                                            <th class="text-right">Paid</th>
                                            <th class="text-right">Commission</th>
                                            <th class="text-right">SubTotal</th>
                                            <th class="text-right">Balance</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $continue=0;
                                        @endphp
                                        @forelse($invoices as $inv)
                                        <tr>
                                            <td class="date_column"><span>{{ $inv->created_at->format('d-m-Y') }}</span>
                                            </td>
                                            <td>{{ $inv->invoice_no }}</td>
                                            <td>
                                                {{ $inv->event }}
                                            </td>
                                           
                                            <td class="text-right">
                                                {{ number_format($inv->total_amount,2) }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($inv->total_paid,2) }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($inv->total_discount,2) }}
                                                                                        </td>
                                            @php
                                                $continue+=($inv->total_amount- $inv->total_discount - $inv->total_paid);
                                            @endphp
                                            <td class="text-right">
                                               {{ number_format(($inv->total_amount -$inv->total_discount- $inv->total_paid),2) }} 
                                            </td>
                                            <td class="text-right">
                                               {{ number_format($continue,2) }} 
                                            </td>
                                        </tr>
                                        
                                        @empty
                                        @endforelse

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th class="text-right" colspan="7">Amount To Paid:</th>
                                            <td class="text-right">{{ number_format($continue,2) }} </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--end searching individual ledger report --}}




{{--    <!-- Main content -->--}}
<section class="content">

</section><!-- /.content -->
<!-- /.content -->
@stop
