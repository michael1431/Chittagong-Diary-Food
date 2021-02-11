@extends('dashboard.marketing.employee')

@section('title','Employee Dashboard')
<style>
    table  th,td {
        padding:5px;

    }
</style>


@section('content')
<hr style="border: 1px solid black">
<div class="row no-print" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <div class="col-lg-2 col-md-2 ">
                    {{Form::label('Date', 'Select Date:', ['class'=>'label-control'])}}
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        {{ Form::text('date',date('Y-m-d'),['class'=>'form-control date-picker daily_log_form','placeholder'=>'Select Date','id'=>'date']) }}
                        @if ($errors->has('date'))
                            <span class="text-danger"><p>{{ $errors->first('date') }}</p></span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2">
                    <div class="form-group{{ $errors->has('working_area') ? 'has-error' : '' }}">
                        {{ Form::button('SEARCH',['class'=>'btn btn-success ','type'=>'submit']) }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
<hr>
    <div class=" text-center">
          <h3><b>SANJIDA ENTERPRISE</b></h3>
          <h4><b>Daily Call Report</b> </h4>
          <table class="table">
              <thead>
              <tr>
                  <th> Name:</th>
                  <th>Designation:</th>
                  <th>Working Area:</th>
                  <th>Date:</th>
              </tr>
              </thead>
          </table>
      </div>
      <div class=" text-center">
          <h4 style="background:whitesmoke ;padding: 8px ;border-radius:2px"><b>Visit Record</b></h4>
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>Doctor Name</th>
                  <th>Gift Items</th>
                  <th>Value</th>
                  <th>Opinion</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              </tbody>
          </table>

      </div>

      <div class=" text-center">
          <h4 style="background:whitesmoke ;padding: 8px ;border-radius:2px"><b>Outlet Orders Record</b></h4>
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>Outlet Detail</th>
                  <th>Collected Order</th>
                  <th>Value</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              </tbody>
          </table>
      </div>

      <br>

      <div class="col-md-6">
          <table class="">
              <thead>
              <tr>
                  <th>Total Gift Used in Taka</th>
                  <td>:</td>
                  <td>200</td>

              </tr>
              <tr>
                  <th width="40%">Total Salary+TA/DA Per Day</th>
                  <td width="10%">:</td>
                  <td width="30%">500</td>

              </tr>
              <tr>
                  <th width="40%">Total Oder Collected in Value</th>
                  <td width="10%">:</td>
                  <td width="30%">400</td>

              </tr>
              <tr>
                  <th width="40%">Each Day Target in Value</th>
                  <td width="10%">:</td>
                  <td width="30%">1000</td>

              </tr>
              <tr>
                  <th width="40%">Achievement Status</th>
                  <td width="10%">:</td>
                  <td width="30%">Good</td>

              </tr>
              </thead>
          </table>
      </div>
      <div class="col-md-6">
          <table class="">
              <thead>
              <tr>
                  <th>Own Opinion:</th>

              </tr>
              </thead>
              <tbody>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              </tbody>
          </table>
      </div>
      <br>
  </div>
<br>

<div class="container-fluid" style="margin-top: 15px">
    <table class="table">
        <thead>
        <tr>
            <th width="30%">Officer</th>
            <th width="25%">AM/RM</th>
            <th width="25%">AMM</th>
            <th width="20%">CEO</th>
        </tr>
        </thead>
    </table>
</div>





@stop
