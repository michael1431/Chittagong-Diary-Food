<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {{ Form::label('','ExpenseType : ') }}
           <select name="expense_type" id="expense_type">
               <option value="1">Daily Office Expense</option>
               <option value="2">Gift</option>
               <option value="3">LC wise Cost</option>
               <option value="4">Salary</option>
           </select>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            {{ Form::label('','L.C No : ') }}
            <select name="lc_no" id="lc_no">
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
            {{ Form::select('cost_id',$costs,null,['class'=>'form-control date','placeholder'=>"Select Cost Type"]) }}

            @if($errors->has('cost_id'))
                <span class="">
                    <strong>{{ $errors->get('cost_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group {{   $errors->has('qty') ? 'has-error' : '' }} ">
            {{ Form::label('','Qty : ') }}
            {{ Form::number('qty',null,['class'=>'form-control','placeholder'=>"Ex. 500 tk"]) }}

            @if($errors->has('qty'))
                <span class="">
                    <strong>{{ $errors->get('qty') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group {{   $errors->has('price') ? 'has-error' : '' }} ">
            {{ Form::label('','Price : ') }}
            {{ Form::number('price',null,['class'=>'form-control','placeholder'=>"Ex. 500 tk"]) }}

            @if($errors->has('price'))
                <span class="">
                    <strong>{{ $errors->get('price') }}</strong>
                </span>
            @endif
        </div>
    </div>
    {{-- <div class="col-lg-12">
        <div class="form-group {{   $errors->has('price') ? 'has-error' : '' }} ">
            {{ Form::label('','Employee : ') }}
            {{ Form::select('emp_user_id',$users,null,['class'=>'form-control','placeholder'=>"Select Employee To assing Gift"]) }}
            @if($errors->has('price'))
                <span class="">
                    <strong>{{ $errors->get('price') }}</strong>
                </span>
            @endif
        </div>
    </div> --}}
    <div class="col-lg-12">
        <div class="form-group {{   $errors->has('amount') ? 'has-error' : '' }} ">
            {{ Form::label('','Cost Amount : ') }}
            {{ Form::number('amount',null,['class'=>'form-control','placeholder'=>"Ex. 500 tk"]) }}

            @if($errors->has('amount'))
                <span class="">
                    <strong>{{ $errors->get('amount') }}</strong>
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
            {{ Form::submit($buttonText,['class'=>'form-control btn btn-success']) }}
        </div>
    </div>


</div>

function empToggle() {
    var type= document.getElementById("cost_type_id").value;
     if(type=='1'){
         document.getElementById("emp_id").style.display ='block';
     }else{
         document.getElementById("emp_id").style.display ='none';
     }     
 }
 function putSalary() {
    var salary= document.getElementById("employee_id").value;
    $("#amount").val(salary.split("|")[1]);       
 }
 $(function(){
     $('#expenseTable').DataTable();
 });
 $('.common-datepicker').datepicker({
     todayHighlight: true,
     format: 'yyyy-mm-dd'
 });
