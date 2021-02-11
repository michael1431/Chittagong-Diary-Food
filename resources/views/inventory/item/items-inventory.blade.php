<div class="table-responsive">
    <table class="table table-hover" id="productTable">
        <thead>
            <tr>
                <td> #SL</td>
                <td> Code</td>
                <td> Name</td>
                <td> Unit</td>
                <td> ProductType</td>
                <td> Group</td>
                <td> Price</td>
                <td> Action</td>
            </tr>
        </thead>

        <tbody id="tbodyItem">
            @php $i=0; @endphp
            @foreach($items as $key=>$info)
                <tr>
                    <td> {{ ++$i }}</td>
                    <td> {{ $info->item_code  }}</td>
                    <td> {{ $info->name  }}</td>
                    <td> {{ $info->product_unit_id !=null ? $info->unit->name : "N/A"  }}</td>
                    <td> {{ $info->department_id !=null ? $info->department->name : "N/A"  }}</td>
                    <td> {{ $info->group_id !=null ? $info->group->name : "N/A"  }}</td>
                    <td> {{ $info->price  }}</td>
                    <td>
                        <a href="{{ route('inventory.item.edit',$info->id) }}" class="btn btn-edit btn-success far fa-edit"></a>
                        {{ Form::button('',['class'=>'btn btn-danger fas fa-trash-alt erase','data-id'=>$info->id,'data-url'=>route('inventory.item.destroy')]) }}

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>


</div>