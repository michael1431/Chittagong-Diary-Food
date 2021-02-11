<div class="table-responsive">
    <table class="table table-hover" id="ProunitTable">
        <thead>
            <tr>
                <td> #SL</td>
                <td> Name</td>
                <td> Description</td>
                <td> Action</td>
            </tr>
        </thead>

        <tbody>
            @php $i=0; @endphp
            @foreach($warehouses as $key=>$warehouse)
                <tr>
                    <td> {{ ++$i }}</td>
                    <td> {{ $warehouse->name  }}</td>
                    <td> {{ $warehouse->description  }}</td>
                    <td>
                        <a href="{{ route('warehouse.edit',$warehouse->id) }}" class="btn btn-edit btn-success far fa-edit"></a>
                        {{ Form::button('',['class'=>'btn btn-danger fas fa-trash-alt erase','data-id'=>$warehouse->id,'data-url'=>route('warehouse.destroy')]) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>