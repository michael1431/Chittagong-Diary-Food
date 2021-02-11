{{Form::label('', 'Group Name ', ['class'=>'label-control'])}}

<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Ex. Group Name']) }}


    @if ($errors->has('name'))
        <p class="text-danger" id="success-alert">
            {{ $errors->first('name') }}
        </p>
    @endif

</div>


<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {{Form::label('description', 'Description', ['class'=>'label-control'])}}
    {{ Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>'','rows'=>5,'cols'=>5]) }}

    @if ($errors->has('description'))
        <span class="text-danger">
                <p>{{ $errors->first('description') }}</p>
            </span>
    @endif
</div>

<div class="form-group row text-right">
    <div class="col-md-12">
        <a href="{{ URL::previous() }}">
            <button  class="btn btn-sm btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-sm btn-success">{{$buttonText}}</button>
        <input type="reset" value="Reset" class="btn btn-sm btn-warning">
    </div>
</div>
