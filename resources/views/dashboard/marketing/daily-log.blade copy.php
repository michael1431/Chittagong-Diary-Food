@extends('dashboard.marketing.employee')

@section('title','Employee Dashboard')


@section('content')
<hr style="border: 1px solid black">
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                <div class="col-lg-4 col-md-4 ">
                    {{Form::label('Date', 'Date:', ['class'=>'label-control'])}}
                </div>
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        {{ Form::text('date',date('Y-m-d'),['class'=>'form-control date-picker daily_log_form','placeholder'=>'Select Date','id'=>'date']) }}
                        @if ($errors->has('date'))
                            <span class="text-danger"><p>{{ $errors->first('date') }}</p></span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="col-lg-3 col-md-3 ">
                    {{Form::label('Area', 'Working Area:', ['class'=>'label-control'])}}
                </div>
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <div class="form-group{{ $errors->has('working_area') ? 'has-error' : '' }}">
                        {{ Form::text('working_area',null,['class'=>'form-control daily_log_form','id'=>'working_area','placeholder'=>'']) }}
                        @if ($errors->has('working_area'))
                            <span class="text-danger"><p>{{ $errors->first('working_area') }}</p></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
  <div class="container-fluid">
    <span class="btn btn-primary btn-block"><h4>Add Visited Doctors</h4></span>

  </div>

  <div class="col-lg-12 card">
    <table class="table table-striped">
      <thead>
      <tr>
        <th>Doctor Name</th>
        <th>Gift Item</th>
        <th>Value</th>
        <th>Opinion</th>
      </tr>
      </thead>

        <tr>
            <td width="30%">
              <div class="form-group {{ $errors->has('doctor_name') ? 'has-error' : '' }}">
                {{ Form::text('doctor_name[]',null,['class'=>'form-control daily_log_form','placeholder'=>'Ex. Doctor Name']) }}
                @if($errors->has('doctor_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('doctor_name') }}</strong>
                  </span>
                @endif
              </div>
            </td>
          <td width="25%">
            <div class="form-group {{ $errors->has('gift_items') ? 'has-error' : '' }}">
              {{ Form::textarea('gift_items[]',null,['class'=>'form-control daily_log_form','placeholder'=>'Ex. Gift Items']) }}
              @if($errors->has('gift_items'))
                <span class="help-block">
                    <strong>{{ $errors->first('gift_items') }}</strong>
                  </span>
              @endif
            </div>
          </td>
          <td width="10%">
              <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                {{--{{ Form::label('','Unit : ') }}--}}
                {{ Form::text('value[]',null,['class'=>'form-control daily_log_form ','placeholder'=>'Ex. Value']) }}
                @if($errors->has('value'))
                  <span class="help-block">
                    <strong>{{ $errors->first('value') }}</strong>
                  </span>
                @endif
              </div>
            </td>

          <td width="25%">
              <div class="form-group {{ $errors->has('opinion') ? 'has-error' : '' }}">
                {{ Form::textarea('opinion[]',null,['class'=>'form-control daily_log_form date','placeholder'=>'Opinion']) }}
                @if($errors->has('opinion'))
                  <span class="help-block">
                    <strong>{{ $errors->first('opinion') }}</strong>
                  </span>
                @endif
              </div>
            </td>

          <td width="10%">
              {{ Form::button("",['class'=>'btn btn-primary fa fa-plus-square btn-lg','id'=>'add_more']) }} ||
              {{ Form::button('',['class'=>'fa fa-trash btn btn-danger btn-lg',"id"=>'remove']) }}

          </td>
          </tr>

      </tbody>
    </table>
  </div>



</div>{{-- row end --}}

<div class="row">
  <div class="container-fluid">
    <span class="btn btn-primary btn-block"><h4>Add Outlet Orders</h4></span>
  </div>
  <div class="col-lg-12 card">
    <table class="table table-striped">
      <thead>
      <tr>
        <th>Products</th>
        <th>Qty</th>
        <th>Trade Price</th>
        <th>Total</th>
      </tr>
      </thead>

      <tr>
        <td width="30%">
          {{-- <div class="form-group {{ $errors->has('outlet_details') ? 'has-error' : '' }}"> --}}
            <div class="form-group">
              <select name="product_id[]" id="product_id[]"></select>
              {{ Form::select('product_id[]',$products,false,['class'=>'form-control commonStock','data-type'=>1,'placeholder'=>'Select Product']) }}
          {{-- </div> --}}
            @if($errors->has('product_id'))
              <span class="help-block">
                    <strong>{{ $errors->first('product_id') }}</strong>
                  </span>
            @endif
          </div>
        </td>
          <td width="20%">
              <div class="form-group {{ $errors->has('order_qty') ? 'has-error' : '' }}">
                  {{ Form::text('order_qty[]',null,['class'=>'form-control daily_log_form','placeholder'=>'Ex. Outlet Details ']) }}
                  @if($errors->has('order_qty'))
                      <span class="help-block">
                    <strong>{{ $errors->first('order_qty') }}</strong>
                  </span>
                  @endif
              </div>
          </td>
        <td width="20%">
          <div class="form-group {{ $errors->has('trade_price') ? 'has-error' : '' }}">
            {{ Form::text('trade_price[]',null,['class'=>'form-control daily_log_form ','placeholder'=>'Ex. trade_price','readonly'=>true]) }}
            @if($errors->has('trade_price'))
              <span class="help-block">
                    <strong>{{ $errors->first('trade_price') }}</strong>
                  </span>
            @endif
          </div>
        </td>
        <td width="20%">
          <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
            {{ Form::text('value[]',null,['class'=>'form-control daily_log_form ','placeholder'=>'Ex. Total Value']) }}
            @if($errors->has('value'))
              <span class="help-block">
                    <strong> {{ $errors->first('value') }} </strong>
                  </span>
            @endif
          </div>
        </td>

        <td width="10%">
          {{ Form::button("",['class'=>'btn btn-primary fa fa-plus-square btn-lg','id'=>'add_more']) }} ||
            {{ Form::button('',['class'=>'fa fa-trash btn btn-danger btn-lg',"id"=>'remove']) }}

        </td>
      </tr>

      </tbody>
    </table>
  </div>
</div>

<div class="container">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
        <div class="form-group">
            {{ Form::button('  SAVE DAILY LOG',['class'=>'btn btn-success','type'=>'submit']) }}
        </div>
    </div>
</div>

  <!-- /.content -->
@stop

@section('plugin')

    <!-- page script -->
    <script type="text/javascript">
        $(document).ready(function () {
            pendingProducts();
        });

        /* pending product list start */
        function pendingProducts() {
            $.ajax({
                method:"get",
                url:"{{ route('inventory.requisition.pending.products') }}",
                dataType:"html",
                success:function (response) {
                    $("#requisition_items").html(response);
                }
            })
        }
   $(document).on('change','#product_id',function () {
            var id = $(this).val();
            if(id !=null){
                $.ajax({
                    method:"post",
                    url:"{{ route('inventory.item.info') }}",
                    data: {id:id, _token:"{{ csrf_token() }}"},
                    dataType:'json',
                    success:function (response) {
                        $("#unit").val(response.unit);
                        $("#price").val(response.price);
                    }
                });
            }
        });
</script>
@stop
