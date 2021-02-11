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
            @foreach($costs as $key=>$cost)
                <tr>
                    <td> {{ ++$i }}</td>
                    <td> {{ $cost->name  }}</td>
                    <td> {{ $cost->description  }}</td>
                    <td>
                        <a href="{{ route('cost.edit',$cost->id) }}" class="btn btn-edit btn-success far fa-edit"></a>
                        {{ Form::button('',['class'=>'btn btn-danger fas fa-trash-alt erase','data-id'=>$cost->id,'data-url'=>route('cost.destroy')]) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>