@extends('layouts.fixed')

@section('title','Manage Requisition - Purcahse Requisition')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>After Checking Requisitions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Requisition</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">

            <div class="card"><br>
                <div class="card-body">
                    <div class="row">
                        {{-- requisition  lists start --}}
                        <div class="col-lg-12 table-responsive">

                            <table class="table-bordered table-striped table">
                                <thead class="bg-info">
                                    <tr>
                                        <th>#SL</th>
                                        <th>Requisition No</th>
                                        <th>R. Invoice No</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total Item</th>
                                        <th>Approved Item</th>
                                        <th>R. Date</th>
                                        <th> Checked By</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @if($requisitions->count()>0)
                                        @foreach($requisitions as $requisition)
                                                <tr >
                                                    <td>{{ ++$i }}</td>
                                                    <td width="11%">{{ $requisition->id }}</td>
                                                    <td>{{ $requisition->invoice_no }}</td>
                                                    <td>{{ $requisition->price }} TK</td>
                                                    <td>{{ $requisition->qty }}</td>

                                                    <td>
                                                        @php $items = \App\RequisitionProduct::where('requisition_id',$requisition->id)->get() @endphp
                                                        {{ $items->count() }}
                                                    </td>

                                                    <td>
                                                        @php $items = \App\RequisitionProduct::where('requisition_id',$requisition->id)->whereNotNUll('user_id')->get() @endphp
                                                        {{ $items->count() }}
                                                    </td>

                                                      <td>
                                                          {{ \Carbon\Carbon::parse($requisition->created_at)->format('D-d-M-Y')   }}  -- {{ $requisition->created_at->diffForHumans() }}
                                                      </td>
                                                    <td>

                                                        {!!  "<label class='label label-primary' style='padding:5px 15px'> ".$requisition->user->name." </label> " !!} </td>
                                                    <td>{{ $requisition->note  }}</td>

                                                    <td>
                                                          <a class="fa fa-eye btn btn-success" href="{{ route('inventory.requisition.approved-items',$requisition->id) }}"> </a>
                                                      </td>
                                                  </tr>
                                        @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                          {{-- requisition  lists End --}}

                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- /.content -->



  @stop

  @section('style')
      <!-- DataTables -->
      <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
  @stop

  @section('plugin')
      <!-- DataTables -->
      <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
      <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script>

      <!-- page script -->
      <script type="text/javascript">
          function adsfasdf() {

          }

      </script>
  @stop
