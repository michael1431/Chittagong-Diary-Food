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
            @foreach($groups as $group)
                <tr>
                    <td> {{ ++$i }}</td>
                    <td> {{ $group->name  }}</td>
                    <td> {{ $group->description  }}</td>
                    <td>
                        <a href="{{ route('inventory.group.edit',$group->id) }}" class="btn btn-edit btn-success far fa-edit"></a>
                        {{ Form::button('',['class'=>'btn btn-danger fas fa-trash-alt erase','data-id'=>$group->id,'data-url'=>route('inventory.group.destroy')]) }}

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>