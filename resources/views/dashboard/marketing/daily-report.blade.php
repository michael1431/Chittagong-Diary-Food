@extends('dashboard.marketing.employee')

@section('title','Employee Order Status')


@section('content')

@section('content')
<div class="row">
    <div class="container-fluid">

    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">

            <div class="card"><br>
                <div class="card-body">
                    <div class="row">

                        {{-- requisition items lists start --}}
                        <div class="col-lg-12 table-responsive">
                            <h4 class="bg-info text-center" style="padding: 10px;">List of Order Item's That You made</h4>
                            <div class="table-responsive">

                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Date</th>
                                            <th>Invoice No</th>
                                            <th>Total</th>                                    
                                            <th>Commission</th>                                   
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                        
                            
                                    <tbody>
                                            @php 
                                                $i=0;
                                                $total=0;
                                            @endphp
                                            @foreach($invoices as $invoice_info)
        
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $invoice_info->created_at }}</td>
                                                    <td>{{ $invoice_info->invoice_no }}</td>
                                                    <td>{{ $invoice_info->total_amount }}</td>
                                                    <td>{{ $invoice_info->total_discount }}</td>
                                                    <td><span class="badge badge-{{ $invoice_info->status? 'info' : 'danger' }}">{{ $invoice_info->status? 'Delivered' : 'Pending' }}</span></td>
                                                    <td>
                                                            <a href="{{ route('invoice.print',$invoice_info->id) }}" target="_blank" class="btn btn-primary fa fa-print"></a>     
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- requisition items lists End --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
</div>
@stop

