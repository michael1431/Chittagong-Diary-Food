<div class="row">
    <div class="col-md-12">
        <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
            {{Form::label('', 'Role Name ', ['class'=>'label-control'])}}
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Ex. ADMIN']) }}
            @if ($errors->has('name'))
            <p class="text-danger" id="success-alert">
                {{ $errors->first('name') }}
            </p>
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
