<div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                {{Form::label('', 'Item Code', ['class'=>'label-control'])}}

              {{--  {{ Form::select('inventory_item_id',$codes,null,['class'=>'form-control findInfo','required','id'=>'inventory_item_id findInfo']) }}--}}

                @php
                    $products = \App\Product::all();
                    ini_set('max_execution_time', 180)
                @endphp

                <select class="form-control" id="product_id">
                    <option>Select Code/Name</option>
                    @if($products->count()>0)
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"> <label class="label-success"> {{ $product->item_code }} </label>    - {{ $product->name  }} - {{ $product->department ? $product->department->name : " " }} - {{ $product->group ? $product->group->name : " " }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('code'))
                    <span class="help-block text-center" id="success-alert">
                    <strong>{{ $errors->first('code') }}</strong>
                </span>
                @endif
            </div>
        </div>



        <div class="col-lg-2 col-sm-2">
            <div class="form-group{{ $errors->has('product_unit_id') ? ' has-error' : '' }}">
                {{Form::label('', 'Unit', ['class'=>'label-control'])}}
                {{ Form::text('product_unit_id',null,['class'=>'form-control','autofocus','readonly','id'=>'unit']) }}

                @if ($errors->has('product_unit_id'))
                    <span class="help-block text-center" id="success-alert">
                    <strong>{{ $errors->first('product_unit_id') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="col-lg-2 col-sm-2">
            <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                {{Form::label('', 'Qty', ['class'=>'label-control'])}}
                {{ Form::text('qty',null,['class'=>'form-control','autofocus','required','placeholder'=>'Ex. 50','autocomplete'=>"off",'id'=>'qty'    ]) }}

                @if ($errors->has('qty'))
                    <span class="help-block text-center" id="success-alert">
                <strong>{{ $errors->first('qty') }}</strong>
            </span>
                @endif
            </div>
        </div>


        <div class="col-lg-2 col-sm-2">
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                {{Form::label('', 'Price', ['class'=>'label-control'])}}
                {{ Form::text('price',null,['class'=>'form-control','autofocus','required','placeholder'=>'Ex. 120 tk','id'=>'price']) }}

                @if ($errors->has('price'))
                    <span class="help-block text-center" id="success-alert">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
                @endif
            </div>
        </div>


        <div class="col-lg-12 col-sm-12">
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                {{Form::label('', 'Note / Remarks / Description ', ['class'=>'label-control'])}}
                {{ Form::textarea('note',null,['class'=>'form-control','autofocus','rows'=>5,'cols'=>5,'placeholder'=>'Ex. Remarks / Note / Description','id'=>'note']) }}

                @if ($errors->has('price'))
                    <span class="help-block text-center" id="success-alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class=" col-lg-3">
            <div class="form-group">
                {{ Form::button("Add To Requisition List",['class'=>'btn btn-primary btn-block storeRequestRequisition']) }}
            </div>
        </div>
</div>

@section('script')
    <!-- page script -->
    <script type="text/javascript">



    </script>
@stop



