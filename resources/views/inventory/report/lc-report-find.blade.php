@php 
@endphp
@if(isset($invoices[0]->id))
    @foreach($invoices as $key => $info)
        <tr id="tr-{{ $info->id }}">
            <td class="text-center">{{ $key + 1 }}</td>
            <td class="text-center">{{ $info->lc_no }}</td>
            <td class="text-left">{{ $info->cost ? $info->cost->name:'purchase' }}</td>
            <td class="text-right">{{ number_format($info->total_amount,2) }}</td>
            <td class="text-center">{{ $info->created_at->diffForHumans() }}</td>
            <td class="text-center">

               <a href="{{ route('lc.edit', $info->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

              {{--<button type="button" onclick="Edit('{{ $info->id }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}

               <button type="button" onclick="Delete('{{ $info->id }}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>

            </td>
        </tr>
    @endforeach
    <tr>
        <th colspan="3" class="text-right">Total Cost</th>
        <th class="text-right">{{ number_format($invoices->sum('total_amount'),2) }}</th>
        <th></th>
    </tr>
@endif

<script type="text/javascript">
    function Delete(id) {
    $.confirm({
        title: 'Confirm!',
        content: '<hr><strong class="text-danger">Are you sure to delete ?</strong><hr>',
        buttons: {
            confirm: function () {
                console.log(id)
                // window.open('{{url('lc-report')}}/'+id+'/delete','_parent');
                $.ajax({
                  // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                  url: "{{url('lc-report')}}/"+id+'/delete',
                  type: 'GET',
                  dataType: 'json',
                  data: {},
                  success:function(response) {
                    if(response.success){
                      $('#tr-'+id).fadeOut();
                    }else{
                      $.alert({
                        title:"Whoops!",
                        content:"<hr><strong class='text-danger'>Something Went Wrong!</strong><hr>",
                        type:"red"
                      });
                    }
                  }
                });
            },
            cancel: function () {

            }
        }
    });   
  }

       
  



</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>