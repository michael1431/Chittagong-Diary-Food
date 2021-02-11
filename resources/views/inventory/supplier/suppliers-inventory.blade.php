<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>#SL</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @php $i=0; @endphp

    @foreach($suppliers as $supplier)
        <tr>
            <td> {{ ++$i }} </td>
            <td> {{ $supplier->name }} </td>
            <td> {{ $supplier->phone }} </td>
            <td> {{ $supplier->address }} </td>
            <td>
                <a href="{{ route('inventory.supplier.edit',$supplier->id) }}" class="btn btn-success fa fa-edit"></a> &nbsp; &nbsp;
                <a href="{{ route('parties.status',['type'=>'Supplier','related_party'=>$supplier->id]) }}" class="btn btn-success">Ledger</a> &nbsp; &nbsp;
                <button type="button" class="fa fa-trash-alt btn btn-danger erase" data-id="{{ $supplier->id }}" data-url="{{ route('inventory.supplier.destroy') }}"></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>