@extends('layouts.fixed')
@section('title','Ledger Book')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Individual Ledger</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        {{--<li class="breadcrumb-item active">City</li>--}}
                        <li class="breadcrumb-item active">Ledgers Report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
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

                        {{Form::open(['url'=>'reports/ledger', 'method'=>'get']) }}

                        <div class="form-row">
                            <div class="form-group col-md-3" style="margin: -2px 0 0 0;">
                                {{Form::label('ledger_name', 'Accounts Name', ['class'=>''])}}
                                {!! Form::select('ledger_name',[],null,['class' => 'form-control','placeholder'=>'Ledger Name']) !!}
                            </div>

                            <div class="form-group col-md-2">
                                {{-- <label class="input-group-addon"></label>--}}
                                {{Form::label('accounts_name', 'From Date', ['class'=>''])}}
                                <input type="text" name="start" id="start" style="margin: -1px 2px" class="datePicker form-control pull-right"  placeholder="select start date">
                            </div>

                            <div class="form-group col-md-2">
                                {{--<label class="input-group-addon"></label>--}}
                                {{Form::label('accounts_name', 'To Date', ['class'=>''])}}
                                <input type="text" name="end" id="end" style="margin: -1px 2px" class="datePicker form-control pull-right"  placeholder="select end date">
                            </div>

                            <div class="form-group col-md-3" style="padding-bottom: 10px; margin: 29px 0 0 0;">
                                <input type="submit" class="btn btn-info" value="search">
                            </div>

                            <div class="form-group  col-md-2" style="padding-bottom:5px; margin: 29px 0 0 0;" >
                                <button class="btn btn-success btn-sm" onclick="window.print(); return false;">Print</button>
                                <button class="btn btn-primary btn-sm" href="#add_show_case" data-toggle="tab">Pdf</button>
                            </div>
                        </div>
                        {{  Form::close() }}

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>{{--end --}}
    </section>
    {{--end searching individual ledger report --}}




    {{--    <!-- Main content -->--}}
    <section class="content">
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
                {{-- end showin gsuccess message --}}
                <br><br>

                {{--                @if($j)--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-lg-12">--}}
                {{--                            @if($rowsFound)--}}
                {{--                                <p style="text-transform: none">--}}
                {{--                                    Matches Total Reports : {{$rowsFound}}--}}
                {{--                                </p>--}}
                {{--                            @endif--}}

                {{--                            Test start --}}
                {{--                                @foreach($j as $ledger)--}}
                {{--                                    <ul>--}}
                {{--                                        <li>Ledger ID :{{$ledger->id}} --{{$ledger->name}}</li>--}}
                {{--                                        <p>---------</p>--}}
                {{--                                        @php--}}
                {{--                                            $journalLists = \App\Account\JournalEntrie::query()->orderBy('ac_journal_id')->get();--}}
                {{--                                        @endphp--}}
                {{--                                            @foreach($journalLists as $journalList)--}}
                {{--                                                {{$journalList->ac_journal_id}}--}}
                {{--                                            @endforeach--}}

                {{--                                    </ul>--}}
                {{--                                @endforeach--}}
                {{--                            Test end --}}

                {{--                            <div class=" bg-light">--}}
                {{--                                @foreach($j as $ledger)--}}
                {{--                                    @php--}}
                {{--                                        $ac_journal =\App\Account\JournalEntrie::query()->select('ac_journal_id')--}}
                {{--                                            ->where('dr_ledger_id',$ledger->id)--}}
                {{--                                            ->orWhere('cr_ledger_id',$ledger->id)--}}
                {{--                                            //->whereNotNull('dr_amount')--}}
                {{--                                            //->orWhereNotNull('cr_amount')--}}
                {{--                                            ->first();--}}

                {{--                                        //ac journal no--}}
                {{--                                        if ($ac_journal){--}}
                {{--                                            $ac_journal_id = $ac_journal->ac_journal_id;--}}


                {{--                                        //{{$ac_journal_id ? $ac_journal_id->ac_journal_id : ''}}--}}

                {{--                                        if ($ac_journal_id){--}}
                {{--                                               $debitsAccounts =\App\Account\JournalEntrie::query()--}}
                {{--                                               ->where('ac_journal_id',$ac_journal_id)--}}
                {{--                                               ->whereNotNull('dr_amount')--}}
                {{--                                               ->get();--}}
                {{--                                        }--}}

                {{--                                      //dd($debitsAccounts);--}}

                {{--                                        if ($ac_journal_id){--}}
                {{--                                            $creditsAccounts =\App\Account\JournalEntrie::query()--}}
                {{--                                                ->where('ac_journal_id',$ac_journal_id)--}}
                {{--                                                ->whereNotNull('cr_amount')--}}
                {{--                                                ->get();--}}
                {{--                                        }--}}
                {{--                                        //dd($creditsAccounts);--}}
                {{--                                    @endphp--}}

                {{--                                --}}{{--   bg-dark--}}
                {{--                                <div class="card card-info card-outline">--}}
                {{--                                    <div class="card-header">--}}
                {{--                                        <h3 class="card-title">Ledger Report</h3>--}}
                {{--                                        <div class="card-tools">--}}
                {{--                                            <button type="button" class="btn btn-tool" data-widget="collapse">--}}
                {{--                                                <i class="fas fa-plus"></i>--}}
                {{--                                            </button>--}}
                {{--                                        </div>--}}
                {{--                                    </div> <!-- /.card-header -->--}}

                {{--                                <div class="card-body" style="display: block;">--}}
                {{--                                    <div class="box-header with-border text-center" style="margin-bottom: -25px!important;">--}}
                {{--                                        <h3 class="unitName">Well Fashion Limited ( Unit-2 )</h3>--}}
                {{--                                        <p style="text-transform: capitalize;text-align: center">BSCIC Industrial Estate <br>Kalurghat Chittagong</p>--}}
                {{--                                        <h3 class="ledgerHeading">{{$ledger->name}} id {{$ledger->id}} group id {{$ledger->group_id}}</h3>--}}
                {{--                                        <p>1-OCT-2018 to 30-Sep-2019</p>--}}
                {{--                                    </div>--}}

                {{--                                    <table class="table table-striped display" id="myTable" style="width:100%">--}}
                {{--                                        <thead>--}}
                {{--                                            <tr>--}}
                {{--                                                <th class="date_column">Date</th>--}}
                {{--                                                <th width="20px"></th>--}}
                {{--                                                <th class="pr">Particulars</th>--}}
                {{--                                                <th width="15%">Vch Type</th>--}}
                {{--                                                <th width="15%">Vch. No/Excise Inv. No</th>--}}
                {{--                                                <th style="width: 40px">Debit Amount</th>--}}
                {{--                                                <th style="width: 40px">Credit Amount</th>--}}
                {{--                                            </tr>--}}
                {{--                                        </thead>--}}

                {{--                                        <tbody>--}}
                {{--                                            <tr>--}}
                {{--                                                <td class="date_column"><span>1-9-2019</span></td>--}}
                {{--                                                <td>To</td>--}}
                {{--                                                <td>Opening Balance</td>--}}
                {{--                                                <td></td>--}}
                {{--                                                <td></td>--}}
                {{--                                                <td>2,28,559.00</td>--}}
                {{--                                                <td></td>--}}
                {{--                                            </tr>--}}



                {{--                                            @foreach($debitsAccounts as $debitAccount)--}}
                {{--                                                @foreach($creditsAccounts as $creditsAccount)--}}

                {{--                                                <li>ac_journal_id : {{$debitAccount->ac_journal_id ? $debitAccount->ac_journal_id : ''}}</li>--}}
                {{--                                                <li>dr_ledger_id  : {{$debitAccount->dr_ledger_id ? $debitAccount->dr_ledger_id : ''}}</li>--}}
                {{--                                                <li>cr_ledger_id  : {{$creditsAccount->cr_ledger_id ? $creditsAccount->cr_ledger_id : ''}}</li>--}}
                {{--                                                <li>dr_amount     : {{$debitAccount->dr_amount ? $debitAccount->dr_amount : ''}}</li>--}}
                {{--                                                @php--}}
                {{--                                                    echo 'Total debits :'.$debitsAccounts->count();--}}
                {{--                                                @endphp--}}
                {{--                                                <hr>--}}

                {{--                                                <li>ac_journal_id : {{$creditsAccount->ac_journal_id ? $creditsAccount->ac_journal_id : ''}}</li>--}}
                {{--                                                <li>cr_ledger_id  : {{$creditsAccount->cr_ledger_id ? $creditsAccount->cr_ledger_id : ''}}</li>--}}
                {{--                                                <li>cr_amount     : {{$creditsAccount->cr_amount ? $creditsAccount->cr_amount : ''}}</li>--}}
                {{--                                                @php--}}
                {{--                                                    echo 'Total credits :'.$creditsAccounts->count();--}}
                {{--                                                @endphp--}}

                {{--                                                @endforeach--}}
                {{--                                            @endforeach--}}

                {{--                                            <tr>--}}
                {{--                                                <td class="date_column"><span>1-9-2019</span></td>--}}
                {{--                                                <th width="20px">To</th>--}}
                {{--                                                <td><span>debit accounts Well Fashion Ltd</span></td>--}}
                {{--                                                <td><span>Cash Receipt</span></td>--}}
                {{--                                                <td class="text-center"><span class="fw_normal">555</span></td>--}}
                {{--                                                <td class="text-right"><span>6,582.00(debit BL)</span></td>--}}
                {{--                                                <td class="text-right"><span></span></td>--}}
                {{--                                                <td class="text-right"><span></span></td>--}}
                {{--                                            </tr>--}}

                {{--                                            @foreach($debitsAccounts as $debitAccount)--}}
                {{--                                                @foreach($creditsAccounts as $creditsAccount)--}}
                {{--                                                    @if($creditsAccounts->count() > 1)--}}
                {{--                                                        <tr>--}}
                {{--                                                            <td class="date_column"><span></span></td>--}}
                {{--                                                            <th width="20px">By </th>--}}
                {{--                                                            <td><span></span>(As Per Details credit)</td>--}}
                {{--                                                            <td><span>Cash Payment</span> </td>--}}
                {{--                                                            <td class="text-center"><span class="fw_normal">2589</span></td>--}}
                {{--                                                            <td class="text-right"><span></span></td>--}}
                {{--                                                            <td class="text-right"><span>4,822.00(cr)</span></td>--}}
                {{--                                                        </tr>--}}

                {{--                                                        <tr>--}}
                {{--                                                            <td class="date_column"><span></span></td>--}}
                {{--                                                            <th width="20px"></th>--}}
                {{--                                                            <td>Fuel & Lubricant -covered van # 425  <span class="float-right">335.00 Dr.</span></td>--}}
                {{--                                                            <td>Cash Payment</td>--}}
                {{--                                                            <td class="text-right"></td>--}}
                {{--                                                            <td class="text-right">100.00</td>--}}
                {{--                                                            <td class="text-right"></td>--}}
                {{--                                                        </tr>--}}
                {{--                                                    @else--}}
                {{--                                                        <tr>--}}
                {{--                                                            <td class="date_column"><span></span></td>--}}
                {{--                                                            <th width="20px"></th>--}}
                {{--                                                            <td>{{$debitAccount->dr_ledger_id ? $debitAccount->debitLedgerName->name : ''}} <span class="float-right">--</span></td>--}}
                {{--                                                            <td>--</td>--}}
                {{--                                                            <td class="text-right"></td>--}}
                {{--                                                            <td class="text-right"></td>--}}
                {{--                                                            <td class="text-right">{{$creditsAccount->cr_amount ? $creditsAccount->cr_amount : ''}}</td>--}}
                {{--                                                        </tr>--}}
                {{--                                                    @endif--}}



                {{--                                                    @if($debitsAccounts->count() > 1)--}}
                {{--                                                        <tr>--}}
                {{--                                                            <td class="date_column"><span></span></td>--}}
                {{--                                                            <th width="20px">By </th>--}}
                {{--                                                            <td><span></span>(As Per Details credit)</td>--}}
                {{--                                                            <td><span>Cash Payment</span> </td>--}}
                {{--                                                            <td class="text-center"><span class="fw_normal">2589</span></td>--}}
                {{--                                                            <td class="text-right"><span></span></td>--}}
                {{--                                                            <td class="text-right"><span>4,822.00(cr)</span></td>--}}
                {{--                                                        </tr>--}}

                {{--                                                        <tr>--}}
                {{--                                                            <td class="date_column"><span></span></td>--}}
                {{--                                                            <th width="20px"></th>--}}
                {{--                                                            <td>Fuel & Lubricant -covered van # 425  <span class="float-right">335.00 Dr.</span></td>--}}
                {{--                                                            <td>Cash Payment</td>--}}
                {{--                                                            <td class="text-right"></td>--}}
                {{--                                                            <td class="text-right">100.00</td>--}}
                {{--                                                            <td class="text-right"></td>--}}
                {{--                                                        </tr>--}}

                {{--                                                    @else--}}
                {{--                                                        <tr>--}}
                {{--                                                            <td class="date_column"><span></span></td>--}}
                {{--                                                            <th width="20px">-</th>--}}
                {{--                                                            <td>{{$creditsAccount->cr_ledger_id ? $creditsAccount->creditLedgerName->name : ''}} <span class="float-right"></span></td>--}}
                {{--                                                            <td><span>--</span> </td>--}}
                {{--                                                            <td class="text-center"><span class="fw_normal">--</span></td>--}}
                {{--                                                            <td class="text-right"><span>{{$debitAccount->dr_amount ? $debitAccount->dr_amount : ''}}</span></td>--}}
                {{--                                                            <td class="text-right"><span></span></td>--}}
                {{--                                                        </tr>--}}
                {{--                                                        <tr>--}}
                {{--                                                            <td class="date_column"><span></span></td>--}}
                {{--                                                            <th width="20px"></th>--}}
                {{--                                                            <td>Fuel & Lubricant -CNG Taxi # 181 <span class="float-right">890.00 Dr.</span></td>--}}
                {{--                                                            <td><span>Cash Payment</span></td>--}}
                {{--                                                            <td class="text-right"><span></span></td>--}}
                {{--                                                            <td class="text-right"><span></span></td>--}}
                {{--                                                            <td class="text-right"><span></span></td>--}}
                {{--                                                            <td class="text-right"><span></span></td>--}}
                {{--                                                        </tr>--}}
                {{--                                                    @endif--}}

                {{--                                                @endforeach--}}
                {{--                                            @endforeach--}}


                {{--                                         <tfoot>--}}
                {{--                                            <tr>--}}
                {{--                                                <td></td>--}}
                {{--                                                <td width="200">Carried Over</td>--}}
                {{--                                                <td></td>--}}
                {{--                                                <td></td>--}}
                {{--                                                <td></td>--}}
                {{--                                                <td><span>12300000.00</span></td>--}}
                {{--                                                <td><span>254557.00</span></td>--}}
                {{--                                            </tr>--}}
                {{--                                        </tfoot>--}}
                {{--                                    </table>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                                @php } @endphp--}}

                {{--                            @endforeach--}}

                {{--                                <div class="pull-right"></div>--}}

                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                @else--}}
                {{--                    <div class="alert alert-danger">--}}
                {{--                        <p>Ledger Report is not available ....</p>--}}
                {{--                    </div>--}}
                {{--                @endif--}}


                <div class="row">
                    <div class="col-lg-12">
                        <div class=" bg-light">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Ledger Report</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div> <!-- /.card-header -->

                                <div class="card-body" style="display: block;">
                                    <div class="box-header with-border text-center" style="margin-bottom: -25px!important;">
                                        <h3>Well Fashion Limited ( Unit-2 )</h3>
                                        <p>BSCIC Indutries Estate</p>
                                        <small>Kalurghat Chittagong</small>

                                        @if (!empty($ledger_name))
                                            {{-- <h3>{{\App\Account\AccountLedger::query()->where('id',$ledger_name)->first()->name }}</h3> --}}
                                        @else
                                            <h3>Select a accounts name</h3>
                                        @endif
                                        <p>1-OCT-2018 to 30-Sep-2019</p>
                                    </div>

                                    <table class="table table-striped display" id="myTable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="date_column">Date</th>
                                                <th width="20px"></th>
                                                <th class="pr">Particulars</th>
                                                <th width="15%">Vch Type</th>
                                                <th width="15%">Vch. No/Excise Inv. No</th>
                                                <th style="width: 40px">Debit Amount</th>
                                                <th style="width: 40px">Credit Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            {{-- @if ($j != null)
                                                @foreach($j as $journals)
                                                    <tr>
                                                        <td class="date_column"><span>{{ $journals->first()->journal->date->format('d-m-Y') }}</span></td>
                                                        <td>
                                                            @if($journals->first()->cr_amount == null)
                                                                BY
                                                            @endif

                                                            @if($journals->first()->dr_amount == null)
                                                                TO
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($journals->count() > 1)
                                                                (as per details) <br>
                                                            @endif

                                                            @foreach($journals as $ledger)
                                                                @if($ledger->dr_amount)
                                                                  {{ $ledger->debitLedgerName->name }} @if($journals->count() > 1){{ number_format($ledger->dr_amount,2) }} Dr.@endif
                                                                @else
                                                                    {{ $ledger->creditLedgerName->name }} @if($journals->count() > 1){{ number_format($ledger->cr_amount,2) }} Cr.@endif
                                                                @endif
                                                                <br>
                                                            @endforeach
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td align="right">
                                                            @if($journals->first()->cr_amount)
                                                                {{ number_format($journals->sum('cr_amount'),2) }}
                                                            @endif
                                                        </td>

                                                        <td align="right">
                                                            @if($journals->first()->dr_amount)
                                                                {{ number_format($journals->sum('dr_amount'),2) }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif --}}
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td><span>1</span></td>
                                                <td width="200">Carried Over</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <span>{{ '00.00' }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ '00.00' }}</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="pull-right"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@stop
@section('style')

@stop
@section('plugin')

@stop

@section('script')
    <!-- page script -->
    <script type="text/javascript">
        $(document).ready(function () {
            window.setTimeout(function() {
                $(".alert").fadeOut(500, function(){
                    $(this).remove();
                });
            }, 1200);

        });

        //delete confirmation  message
        function confirmDelete(){
            var x = confirm('Are you sure you want to delete this ?');
            return !!x;
        }

        //search report date wise (function for date picker)
        $(function () {
            $('.datePicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });
        })
    </script>
@stop



@section('css')
    <style>
        .table tr td, .table tr th{
            border: none;
        }
        span.tab { margin-left: 40px; }
        td.underline{
            border-bottom: solid 2px;
        }
        table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
            border-top: 0px solid #ddd!important;
        }
        .date_column{
            text-align: right;
        }
        tr td {
            font-weight: bold;
        }
        .fw_normal {
            font-weight: normal;
        }
        .ledgerHeading {
            font-size: 17px!important;
            margin: -8px 0 23px 0;
            font-weight: bold;
        }
        .unitName {
            font-size: 21px;
            font-weight: bold;
        }
    </style>
@stop
{{--end by ahmed --}}