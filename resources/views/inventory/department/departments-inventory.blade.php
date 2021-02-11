<div class="table-responsive">
    <table class="table table-hover" id="InventoryDepartMentTable">
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
            @foreach($departments as $department)
                <tr>
                    <td> {{ ++$i }}</td>
                    <td> {{ $department->name  }}</td>
                    <td> {{ $department->description  }}</td>
                    <td>
                        <a href="{{ route('inventory.department.edit',$department->id) }}" class="btn btn-edit btn-success far fa-edit"></a>
                        {{ Form::button('',['class'=>'btn btn-danger fas fa-trash-alt erase','data-id'=>$department->id,'data-url'=>route('inventory.department.destroy')]) }}

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>