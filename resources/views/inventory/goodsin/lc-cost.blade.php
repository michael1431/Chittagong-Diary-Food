@extends('layouts.fixed')
@section('title','ExpenseManagement   - CDF ')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage  Expense </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Expense</li>
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
                                <h3 class="card-title">Add Expense </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-lg-3">
                                        {{ Form::open(['route'=>'lccost.store','method'=>'post', 'class'=>'form-horizontal']) }}
                                        {{-- @include('inventory.goodsin.form-lccost',['buttonText'=>'Save LC-Cost']) --}}
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    {{ Form::label('','ExpenseType : ') }}
                                                   <select name="expense_type" onchange="qtyToggle()" id="expense_type">
                                                       <option value="1">Daily Office Expense</option>
                                                       <option value="2">Purchase Gift or Stationary</option>
                                                       <option value="3">LC wise Cost</option>
                                                       <option value="4">Salary</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12" id="lc_cost_option" style="display:none">
                                                <div class="form-group">
                                                    {{ Form::label('','L.C No : ') }}
                                                    <select name="lc_no" id="lc_no" class="lc_cost">
                                                        <option value="">Select LC No</option>
                                                        @forelse($lcs as $lc)
                                                            @if($lc)
                                                                <option value="{{ $lc }}">{{ $lc }}</option>
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="col-lg-12">
                                                <div class="form-group {{   $errors->has('cost_id') ? 'has-error' : '' }} ">
                                                    {{ Form::label('','Cost Type : ') }}
                                                    {{-- {{ Form::select('cost_id',$costs,null,['id'=>'cost_id','onchange'=>'qtyToggle()','required'=>'required','class'=>'form-control date','placeholder'=>"Select Cost Type"]) }}
                                                    --}}
                                                <select name="cost_id" id="cost_id" class="form-control" required>
                                                    <option value="">Select Cost Type</option>
                                                    @forelse($costs as $key=>$cost)
                                                        @if($cost)
                                                            <option value="{{ $key }}">{{ $cost }}</option>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                    @if($errors->has('cost_id'))
                                                        <span class="">
                                                            <strong>{{ $errors->get('cost_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </select>
                                                </div>
                                            </div>

                                        <div id="qty_option" style="display:none" class="col-lg-12">
                                                <div class="col-lg-12">
                                                    <div class="form-group {{   $errors->has('product') ? 'has-error' : '' }} ">
                                                        {{ Form::label('','Product : ') }}
                                                        <select name="product" id="product" class="form-control" required>
                                                            <option value="null">Select Product</option>
                                                            @forelse($giftProducts as $key=>$product)
                                                                @if($product)
                                                                    <option value="{{ $key }}">{{ $product }}</option>
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                            @if($errors->has('product'))
                                                                <span class="">
                                                                    <strong>{{ $errors->get('product') }}</strong>
                                                                </span>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-lg-12">
                                                <div class="form-group {{   $errors->has('qty') ? 'has-error' : '' }} ">
                                                    {{ Form::label('','Qty : ') }}
                                                    {{ Form::number('qty',0,['id'=>'qty','onchange'=>'sumUp()','class'=>'form-control','placeholder'=>"Ex. 500 tk"]) }}
                                        
                                                    @if($errors->has('qty'))
                                                        <span class="">
                                                            <strong>{{ $errors->get('qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group {{   $errors->has('price') ? 'has-error' : '' }} ">
                                                    {{ Form::label('','Price : ') }}
                                                    {{ Form::number('price',0,['id'=>'price','onchange'=>'sumUp()','class'=>'form-control','placeholder'=>"Ex. 500 tk"]) }}
                                        
                                                    @if($errors->has('price'))
                                                        <span class="">
                                                            <strong>{{ $errors->get('price') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-lg-12">
                                                <div class="form-group {{   $errors->has('amount') ? 'has-error' : '' }} ">
                                                    {{ Form::label('','Cost Amount : ') }}
                                                    {{ Form::number('amount',null,['id'=>'amount','class'=>'form-control','placeholder'=>"Ex. 500 tk"]) }}


                                                    @if($errors->has('amount'))
                                                        <span class="">
                                                            <strong>{{ $errors->get('amount') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        
                                                <div class="col-lg-12">
                                                <div class="form-group {{   $errors->has('lc_cost_date') ? 'has-error' : '' }} ">
                                                    {{ Form::label('','Date : ') }}
                                                    {{ Form::date('lc_cost_date',null,['id'=>'lc_cost_date','class'=>'form-control','placeholder'=>"lc Cost date"]) }}


                                                    @if($errors->has('lc_cost_date'))
                                                        <span class="">
                                                            <strong>{{ $errors->get('lc_cost_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        
                                            <div class="col-lg-12">
                                                <div class="form-group {{   $errors->has('note') ? 'has-error' : '' }} ">
                                                    {{ Form::label('','Cost Note : ') }}
                                                    {{ Form::textarea('note',null,['class'=>'form-control','placeholder'=>"Ex. Cost Note",'cols'=>5,'rows'=>5]) }}
                                        
                                                    @if($errors->has('note'))
                                                        <span class="">
                                                            <strong>{{ $errors->get('note') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="col-lg-12">
                                                <div class="form-group {{   $errors->has('amount') ? 'has-error' : '' }} ">
                                                    {{ Form::submit('Submit Expenses',['class'=>'form-control btn btn-success']) }}
                                                </div>
                                            </div>
                                        
                                        
                                        </div>

                                        {{ Form::close() }}
                                    </div>

                                    {{-- <div class="col-lg-9 table-responsive">
                                        <table class="table table-hover dataTable" >
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>LC No</th>
                                                    <th>Cost Type</th>
                                                    <th>Cost Amount</th>
                                                    <th>Cost Note</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @include('inventory.goodsin.costs') 
                                            </tbody>

                                        </table>
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{--create/edit  start --}}



            </div>
        </div>
    </section><!-- /.content -->
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
                $(".alert").fadeOut(500, function(){
                    $(this).remove();
                });
            }, 1200);

        });

        function qtyToggle() {
           var type= document.getElementById("expense_type").value;
           //alert(type);
            if(type=='2'){
                document.getElementById("qty_option").style.display ='block';
                document.getElementById("lc_cost_option").style.display ='none';
                $("#amount").attr('readonly',true);

            }else if(type=='3'){
                document.getElementById("qty_option").style.display ='none';
                document.getElementById("lc_cost_option").style.display ='block';
                $("#amount").attr('readonly',false);
                $(".lc_cost").select2({
                    tags: true
                });
            }else{
                document.getElementById("qty_option").style.display ='none';
                document.getElementById("lc_cost_option").style.display ='none';
                $("#amount").attr('readonly',false);
            }     
        }
        //delete confirmation  message
        function confirmDelete(){
            var x = confirm('Are you sure you want to delete this ?');
            return !!x;
        }
        function sumUp(){
            var q = document.getElementById("qty").value;
            var p = document.getElementById("price").value;
            document.getElementById("amount").value=(p*q);
        }

    </script>
@stop