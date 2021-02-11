@if($lccosts->count()>0)
    @php $sl=0; @endphp
    @foreach($lccosts as $key=>$info)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{ $info->lc->lc }}</td>
            <td>{{ $info->cost->name }}</td>
            <td>{{ $info->amount }} TK</td>
            <td> {{ $info->note !=null ? substr($info->note,0,150) .' ... More' : ' N/A' }}  </td>
            <td><a href="#" class="btn btn-primary far fa-eye"></a> </td>
        </tr>
    @endforeach
@endif