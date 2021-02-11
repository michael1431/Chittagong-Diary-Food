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
            @foreach($units as $unit)
                <tr>
                    <td> {{ ++$i }}</td>
                    <td> {{ $unit->name  }}</td>
                    <td> {{ $unit->description  }}</td>
                    <td>
                        <a href="{{ route('inventory.unit.edit',$unit->id) }}" class="btn btn-edit btn-success far fa-edit"></a>
                        {{ Form::button('',['class'=>'btn btn-danger fas fa-trash-alt erase','data-id'=>$unit->id,'data-url'=>route('inventory.unit.destroy')]) }}

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>