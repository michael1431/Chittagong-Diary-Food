<div class="row">
    <div class="col-md-12">
        <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
            {{Form::label('', 'Item Name ', ['class'=>'label-control'])}}
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Ex. 1 No Amper Tube']) }}
            @if ($errors->has('name'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('name') }}
            </p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('item_code') ? 'has-error' : '' }}">
            {{Form::label('', 'Item Code ', ['class'=>'label-control'])}}

            {{ Form::text('item_code',null,['class'=>'form-control','placeholder'=>'W#00001']) }}

            @if ($errors->has('item_code'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('item_code') }}
            </p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('product_unit_id') ? 'has-error' : '' }}">
            {{ Form::label('', 'Item Unit', ['class'=>'label-control'])}}
            {{ Form::select('product_unit_id',$units,null,['class'=>'form-control']) }}

            @if ($errors->has('product_unit_id'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('product_unit_id') }}
            </p>
            @endif
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group{{ $errors->has('mrp') ? 'has-error' : '' }}">
            {{ Form::label('', 'Maximum Retail Price ', ['class'=>'label-control'])}}
            {{ Form::text('mrp',null,['class'=>'form-control','placeholder'=>'Ex. 50 TK']) }}
            @if ($errors->has('mrp'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('mrp') }}
            </p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('price') ? 'has-error' : '' }}">
            {{ Form::label('', 'Trade Price ', ['class'=>'label-control'])}}
            {{ Form::text('price',null,['class'=>'form-control','placeholder'=>'Ex. 50 TK']) }}
            @if ($errors->has('price'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('price') }}
            </p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('marketing_commission') ? 'has-error' : '' }}">
            {{ Form::label('', 'Marketing Commission', ['class'=>'label-control'])}}
            {{ Form::text('marketing_commission',null,['class'=>'form-control','placeholder'=>'Ex. 50 TK']) }}
            @if ($errors->has('marketing_commission'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('marketing_commission') }}
            </p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('employee_commission') ? 'has-error' : '' }}">
            {{ Form::label('', 'Employee Commission', ['class'=>'label-control'])}}
            {{ Form::text('employee_commission',null,['class'=>'form-control','placeholder'=>'Ex. 50 TK']) }}
            @if ($errors->has('employee_commission'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('employee_commission') }}
            </p>
            @endif
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('department_id') ? 'has-error' : '' }}">
            {{ Form::label('', 'ProductType', ['class'=>'label-control'])}}
            {{ Form::select('department_id',$departments,null,['class'=>'form-control']) }}

            @if ($errors->has('department_id'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('department_id') }}
            </p>
            @endif
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group{{ $errors->has('group_id') ? 'has-error' : '' }}">
            {{ Form::label('', 'Group', ['class'=>'label-control'])}}
            {{ Form::select('group_id',$groups,null,['class'=>'form-control']) }}

            @if ($errors->has('group_id'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('group_id') }}
            </p>
            @endif
        </div>

    </div>
    <div class="col-md-12">



        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {{Form::label('description', 'Description', ['class'=>'label-control'])}}
            {{ Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>'','rows'=>5,'cols'=>5]) }}

            @if ($errors->has('description'))
            <span class="text-danger">
                <p> {{ $errors->first('description') }} </p>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row text-right">
            <div class="col-md-12">
                <a href="{{ URL::previous() }}">
                    <button class="btn btn-sm btn-danger">Back</button>
                </a>
                <button type="submit" class="btn btn-sm btn-success">{{$buttonText}}</button>
                <input type="reset" value="Reset" class="btn btn-sm btn-warning">
            </div>
        </div>
    </div>
</div>
