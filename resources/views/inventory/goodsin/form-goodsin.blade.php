    <div class="col-lg-3">
        <div class="form-group {{   $errors->has('lc') ? 'has-error' : '' }} ">
            {{ Form::label('','L.C No : ') }}
            {{ Form::text('lc',null,['class'=>'form-control','placeholder'=>"Ex. LC1"]) }}

            @if($errors->has('lc'))
                <span class="">
                    <strong>{{ $errors->get('chalan_date') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="col-lg-3">
        <div class="form-group {{   $errors->has('lc_date') ? 'has-error' : '' }} ">
            {{ Form::label('','L.C Date : ') }}
            {{ Form::text('lc_date',null,['class'=>'form-control date','placeholder'=>"Ex. LC1"]) }}

            @if($errors->has('lc_date'))
                <span class="">
                    <strong>{{ $errors->get('lc_date') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="col-lg-3">
        <div class="form-group">
            {{ Form::label('','Purchase Order  : ') }}
            {{ Form::select('purchase_id',$purchases,false,['class'=>'form-control purchase_id ','placeholder'=>"Select Purchase Order "]) }}
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group {{   $errors->has('chalan') ? 'has-error' : '' }} ">

            {{ Form::label('','Chalan No : ') }}
            {{ Form::text('chalan',null,['class'=>'form-control','placeholder'=>"Ex. 101"]) }}

            @if($errors->has('chalan'))
                <span class="">
                    <strong>{{ $errors->get('chalan') }}</strong>
                </span>
            @endif

        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group {{   $errors->has('chalan_date') ? 'has-error' : '' }} ">
            {{ Form::label('','Chalan Date : ') }}
            {{ Form::text('chalan_date',null,['class'=>'form-control date','placeholder'=>"Ex. LC1"]) }}

            @if($errors->has('chalan_date'))
                <span class="">
                    <strong>{{ $errors->get('chalan_date') }}</strong>
                </span>
            @endif
        </div>
    </div>


