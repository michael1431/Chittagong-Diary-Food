<div class="table-responsive">
    <table class="table table-hover" id="productTable">
        <thead>
            <tr>
                <td> #SL</td>
                <td>Roles</td>
                <td> Permissions</td>
                <td> Action</td>
            </tr>
        </thead>

        <tbody id="tbodyItem">
            @php $i=0; @endphp
            @foreach($roles as $key=>$info)
                <tr>
                    <td> {{ ++$i }}</td>
                    <td> {{ $info->name  }}</td>
                    <td>
                        @forelse($info->permissions as $permission)
                        <span class="badge badge-info">{{ $permission->lebel }}</span>
                        @empty
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('users.roles.edit',$info->id) }}" class="btn btn-edit btn-success far fa-edit"></a>
                        {{ Form::button('',['class'=>'btn btn-danger fas fa-trash-alt erase','data-id'=>$info->id,'data-url'=>route('users.roles.destroy')]) }}

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>


</div>