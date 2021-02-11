<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {{Form::label('details', 'Supplier Name', ['class'=>'label-control'])}}
    {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Enter Party / Supplier name','autofocus','required']) }}

    @if ($errors->has('name'))
        <span class="help-block text-center" id="success-alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>


<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    {{Form::label('details', 'Supplier Phone', ['class'=>'label-control'])}}
    {{ Form::text('phone',old('phone'),['class'=>'form-control','placeholder'=>'Ex. 01800-000000','autofocus','required']) }}

    @if ($errors->has('phone'))
        <span class="help-block text-center" id="success-alert">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
    {{Form::label('details', 'Supplier Address', ['class'=>'label-control'])}}
    {{ Form::textarea('address',old('details'),['class'=>'form-control','placeholder'=>'Shortly Brief about Party/Supplier address','rows'=>5,'cols'=>5]) }}

    @if ($errors->has('details'))
        <span class="help-block">
            <strong>{{ $errors->first('details') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <div class="">
        {{ Form::submit($save, ['class'=>'btn btn-success btn-block']) }}
    </div>
</div>