<form method="GET" action="{{ route('lc.report') }}">
    <div class="col-lg-12">
    
        <div class="form-group">
            {{ Form::label('','LC No : ') }}
            <select name="lc_no" id="lc_no" class="form-control" required>
                @foreach ($lcs as $lc)
                    @if ($lc)
                        <option value="{{$lc}}" @if($lc_no == $lc) selected @endif>{{$lc}}</option>
                     @endif
                @endforeach

            </select>
            {{-- {{ Form::select('lc_no',$lcs,null,['class'=>'form-control goodsin_id']) }} --}}
        </div>
    
    </div>


    <div class="col-lg-12">
        <div class="form-group">
            {{-- <button type="submit" class="btn btn-success getGoodsIn">{{ $buttonText }}</button> --}}
            {{ Form::button($buttonText,['class'=>'btn btn-success getGoodsIn']) }}
        </div>
    </div>
</form>