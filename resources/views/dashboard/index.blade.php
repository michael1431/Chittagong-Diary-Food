@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row" id="print_portion4">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$todaysCosts->sum('total_amount')}} <sup style="font-size: 20px">৳</sup></h3>

                            <p>Today's Expense</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$pending_orders->count()}} <sup style="font-size: 20px">No</sup></h3>

                            <p>Today's Pending Order</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$todays_sales}} <sup style="font-size: 20px">৳</sup></h3>

                            <p>Today's Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $todays_purchase }} <sup style="font-size: 20px">৳</sup></h3>
                            <p>Today's Purchase</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="text-right no-print" id="btn_print4">
                    <button class="btn btn-primary" onclick="printData(4)"><i class="fa fa-print"></i></button>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
             <!-- Small boxes (Stat box) -->
             <div class="row">
                <div class="col-lg-6 col-6" id="print_portion2">
                   
                        <div class="card o-hidden mb-4">
                            <div class="card-header">
                                <h3 class="w-50 float-left card-title m-0">Today's Expenses</h3>
                                <div class="dropdown dropleft text-right w-50 float-right">
                                    <button class="btn bg-gray-100" type="button" id="dropdownMenuButton_table4"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="nav-icon i-Gear-2"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">  
                                    <table id="expense_table" class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Details</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($todaysCosts as $key=>$ex)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{ \Carbon\Carbon::parse($ex->created_at)->format('d-M-Y') }}</td>
                                                <td>
    
                                                    {{ $ex->cost->name }}
    
                                                </td>
    
                                                <td>{{ $ex->total_amount }}</td>
                                                <td>
                                                    <a href="{{ route('invoice.print',$ex->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @empty
                                                
                                            @endforelse
                                           
                                           
    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="cart-footer">
                                <div class="text-right no-print" id="btn_print2">
                                    <button class="btn btn-primary" onclick="printData(2)"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="col-lg-6 col-6" id="print_portion3">
                    <div class="card o-hidden mb-4">
                        <div class="card-header">
                            <h3 class="w-50 float-left card-title m-0">Today's Sales</h3>
                            <div class="dropdown dropleft text-right w-50 float-right">
                                           <button class="btn bg-gray-100" type="button" id="dropdownMenuButton_table4"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="nav-icon i-Gear-2"></i>
                                        </button>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                
                                <table id="order_table" class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">OrderBy</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pending_orders as $key=>$pendingOrder)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{ \Carbon\Carbon::parse($pendingOrder->created_at)->format('d-M-Y') }}</td>
                                            <td>

                                                {{ $pendingOrder->order_by->name }}

                                            </td>

                                            <td>{{ $pendingOrder->total_amount}}</td>
                                            <td>
                                                <a href="{{ route('invoice.print',$pendingOrder->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                            
                                        @endforelse
                                       
                                       

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="cart-footer">
                            <div class="text-right no-print" id="btn_print3">
                                <button class="btn btn-primary" onclick="printData(3)"><i class="fa fa-print"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="print_portion1">
                <div class="card"><br>
                    <div class="card-header">
                        <h3 class="w-50 float-left card-title m-0">Today's Transactions</h3>
                        <div class="dropdown dropleft text-right w-50 float-right">
                            <button class="btn bg-gray-100" type="button" id="dropdownMenuButton_table4"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nav-icon i-Gear-2"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table class="table-bordered table-striped table">
                                    <thead>
                                        <th>#SL</th>
                                        <th>Invoice No</th>
                                        <th>Party</th>
                                        <th>Event</th>
                                        <th>Total</th>                                    
                                        <th>Commission</th>                                   
                                        <th>Paid/Received</th>
                                        <th>Action</th>
                                    </thead>
    
                                   
                                    <tbody>
                                        @php 
                                            $i=0;
                                            $total=0;
                                        @endphp
                                        @foreach($invoices as $invoice_info)
    
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $invoice_info->invoice_no }}</td>
                                                
                                                @if($invoice_info->related_party_type !== null && $invoice_info->related_party_type == 'Customer')
                                                    <td><strong class="badge badge-success"> Customer </strong>  {{ $invoice_info->order_by->name ?? 'N/A' }}</td>
                                                  
                                                @elseif($invoice_info->related_party_type !== null && $invoice_info->related_party_type == 'Supplier')
                                                    <td><strong class="badge badge-info"> Supplier </strong>   {{ $invoice_info->supplier->name ?? 'N/A' }}</td>
    
                                                @elseif($invoice_info->related_party_type !== null && $invoice_info->related_party_type == 'Employee')
                                                    <td><strong class="badge badge-warning"> Employee </strong>   {{ $invoice_info->employee->name ?? 'N/A' }}</td>
                                        
                                                @else
                                                    <td>
                                                        <strong class="badge badge-danger"> Expenses </strong>
                                                        {{ $invoice_info->cost->name ?? 'N/A' }}
                                                       
                                                    </td>
                                                @endif
                                                
                                                <td>{{ strtoupper($invoice_info->event) }}</td>
                                                <td>{{ $invoice_info->total_amount }}</td>
                                                <td>{{ $invoice_info->total_discount }}</td>
                                                {{-- <td>{{ $invoice_info->total_less }}</td> --}}
                                                <td>{{ $invoice_info->total_paid }}</td>
                                                {{-- <td>{{ $invoice_info->created_at}}</td> --}}
                                                <td>
                                                        <a href="{{ route('invoice.print',$invoice_info->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        {{-- <a href="{{ url('SaleManagement/sale-invoice/'.$invoice_info->id) }}" target="_blank" class="btn btn-primary fa fa-print"> Double</a>
                                                        <a href="{{ url('Reports/Invoice-Delete/'.$invoice_info->id) }}" class="btn btn-danger fa fa-trash">  Delete</a> --}}
    
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>
                            {{-- requisition  lists End --}}
    
                        </div>
                    </div>
                    <div class="cart-footer">
                        <div class="text-right no-print" id="btn_print1">
                            <button class="btn btn-primary" onclick="printData(1)"><i class="fa fa-print"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            {{--
                   <!-- Main row -->
                   <div class="row">
                       <!-- Left col -->
                       <section class="col-lg-7 connectedSortable">
                           <!-- Custom tabs (Charts with tabs)-->
                           <div class="card">
                               <div class="card-header d-flex p-0">
                                   <h3 class="card-title p-3">
                                       <i class="fas fa-chart-pie mr-1"></i>
                                       Sales
                                   </h3>
                                   <ul class="nav nav-pills ml-auto p-2">
                                       <li class="nav-item">
                                           <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                       </li>
                                       <li class="nav-item">
                                           <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                       </li>
                                   </ul>
                               </div><!-- /.card-header -->
                               <div class="card-body">
                                   <div class="tab-content p-0">
                                       <!-- Morris chart - Sales -->
                                       <div class="chart tab-pane active" id="revenue-chart"
                                            style="position: relative; height: 300px;"></div>
                                       <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                                   </div>
                               </div><!-- /.card-body -->
                           </div>
                           <!-- /.card -->

                           <!-- DIRECT CHAT -->
                           <div class="card direct-chat direct-chat-primary">
                               <div class="card-header">
                                   <h3 class="card-title">Direct Chat</h3>

                                   <div class="card-tools">
                                       <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
                                       <button type="button" class="btn btn-tool" data-widget="collapse">
                                           <i class="fas fa-minus"></i>
                                       </button>
                                       <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                               data-widget="chat-pane-toggle">
                                           <i class="fas fa-comments"></i>
                                       </button>
                                       <button type="button" class="btn btn-tool" data-widget="remove"><i class="fas fa-times"></i>
                                       </button>
                                   </div>
                               </div>
                               <!-- /.card-header -->
                               <div class="card-body">
                                   <!-- Conversations are loaded here -->
                                   <div class="direct-chat-messages">
                                       <!-- Message. Default to the left -->
                                       <div class="direct-chat-msg">
                                           <div class="direct-chat-info clearfix">
                                               <span class="direct-chat-name float-left">Alexander Pierce</span>
                                               <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                           </div>
                                           <!-- /.direct-chat-info -->
                                           <img class="direct-chat-img" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="message user image">
                                           <!-- /.direct-chat-img -->
                                           <div class="direct-chat-text">
                                               Is this template really for free? That's unbelievable!
                                           </div>
                                           <!-- /.direct-chat-text -->
                                       </div>
                                       <!-- /.direct-chat-msg -->

                                       <!-- Message to the right -->
                                       <div class="direct-chat-msg right">
                                           <div class="direct-chat-info clearfix">
                                               <span class="direct-chat-name float-right">Sarah Bullock</span>
                                               <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                           </div>
                                           <!-- /.direct-chat-info -->
                                           <img class="direct-chat-img" src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="message user image">
                                           <!-- /.direct-chat-img -->
                                           <div class="direct-chat-text">
                                               You better believe it!
                                           </div>
                                           <!-- /.direct-chat-text -->
                                       </div>
                                       <!-- /.direct-chat-msg -->

                                       <!-- Message. Default to the left -->
                                       <div class="direct-chat-msg">
                                           <div class="direct-chat-info clearfix">
                                               <span class="direct-chat-name float-left">Alexander Pierce</span>
                                               <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                           </div>
                                           <!-- /.direct-chat-info -->
                                           <img class="direct-chat-img" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="message user image">
                                           <!-- /.direct-chat-img -->
                                           <div class="direct-chat-text">
                                               Working with AdminLTE on a great new app! Wanna join?
                                           </div>
                                           <!-- /.direct-chat-text -->
                                       </div>
                                       <!-- /.direct-chat-msg -->

                                       <!-- Message to the right -->
                                       <div class="direct-chat-msg right">
                                           <div class="direct-chat-info clearfix">
                                               <span class="direct-chat-name float-right">Sarah Bullock</span>
                                               <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                           </div>
                                           <!-- /.direct-chat-info -->
                                           <img class="direct-chat-img" src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="message user image">
                                           <!-- /.direct-chat-img -->
                                           <div class="direct-chat-text">
                                               I would love to.
                                           </div>
                                           <!-- /.direct-chat-text -->
                                       </div>
                                       <!-- /.direct-chat-msg -->

                                   </div>
                                   <!--/.direct-chat-messages-->

                                   <!-- Contacts are loaded here -->
                                   <div class="direct-chat-contacts">
                                       <ul class="contacts-list">
                                           <li>
                                               <a href="#">
                                                   <img class="contacts-list-img" src="{{ asset('dist/img/user1-128x128.jpg') }}">

                                                   <div class="contacts-list-info">
                                 <span class="contacts-list-name">
                                   Count Dracula
                                   <small class="contacts-list-date float-right">2/28/2015</small>
                                 </span>
                                                       <span class="contacts-list-msg">How have you been? I was...</span>
                                                   </div>
                                                   <!-- /.contacts-list-info -->
                                               </a>
                                           </li>
                                           <!-- End Contact Item -->
                                           <li>
                                               <a href="#">
                                                   <img class="contacts-list-img" src="{{ asset('dist/img/user7-128x128.jpg') }}">

                                                   <div class="contacts-list-info">
                                 <span class="contacts-list-name">
                                   Sarah Doe
                                   <small class="contacts-list-date float-right">2/23/2015</small>
                                 </span>
                                                       <span class="contacts-list-msg">I will be waiting for...</span>
                                                   </div>
                                                   <!-- /.contacts-list-info -->
                                               </a>
                                           </li>
                                           <!-- End Contact Item -->
                                           <li>
                                               <a href="#">
                                                   <img class="contacts-list-img" src="{{ asset('dist/img/user3-128x128.jpg') }}">

                                                   <div class="contacts-list-info">
                                 <span class="contacts-list-name">
                                   Nadia Jolie
                                   <small class="contacts-list-date float-right">2/20/2015</small>
                                 </span>
                                                       <span class="contacts-list-msg">I'll call you back at...</span>
                                                   </div>
                                                   <!-- /.contacts-list-info -->
                                               </a>
                                           </li>
                                           <!-- End Contact Item -->
                                           <li>
                                               <a href="#">
                                                   <img class="contacts-list-img" src="{{ asset('dist/img/user5-128x128.jpg') }}">

                                                   <div class="contacts-list-info">
                                 <span class="contacts-list-name">
                                   Nora S. Vans
                                   <small class="contacts-list-date float-right">2/10/2015</small>
                                 </span>
                                                       <span class="contacts-list-msg">Where is your new...</span>
                                                   </div>
                                                   <!-- /.contacts-list-info -->
                                               </a>
                                           </li>
                                           <!-- End Contact Item -->
                                           <li>
                                               <a href="#">
                                                   <img class="contacts-list-img" src="{{ asset('dist/img/user6-128x128.jpg') }}">

                                                   <div class="contacts-list-info">
                                 <span class="contacts-list-name">
                                   John K.
                                   <small class="contacts-list-date float-right">1/27/2015</small>
                                 </span>
                                                       <span class="contacts-list-msg">Can I take a look at...</span>
                                                   </div>
                                                   <!-- /.contacts-list-info -->
                                               </a>
                                           </li>
                                           <!-- End Contact Item -->
                                           <li>
                                               <a href="#">
                                                   <img class="contacts-list-img" src="{{ asset('dist/img/user8-128x128.jpg') }}">

                                                   <div class="contacts-list-info">
                                 <span class="contacts-list-name">
                                   Kenneth M.
                                   <small class="contacts-list-date float-right">1/4/2015</small>
                                 </span>
                                                       <span class="contacts-list-msg">Never mind I found...</span>
                                                   </div>
                                                   <!-- /.contacts-list-info -->
                                               </a>
                                           </li>
                                           <!-- End Contact Item -->
                                       </ul>
                                       <!-- /.contacts-list -->
                                   </div>
                                   <!-- /.direct-chat-pane -->
                               </div>
                               <!-- /.card-body -->
                               <div class="card-footer">
                                   <form action="#" method="post">
                                       <div class="input-group">
                                           <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                           <span class="input-group-append">
                             <button type="button" class="btn btn-primary">Send</button>
                           </span>
                                       </div>
                                   </form>
                               </div>
                               <!-- /.card-footer-->
                           </div>
                           <!--/.direct-chat -->

                           <!-- TO DO List -->
                           <div class="card">
                               <div class="card-header">
                                   <h3 class="card-title">
                                       <i class="ion ion-clipboard mr-1"></i>
                                       To Do List
                                   </h3>

                                   <div class="card-tools">
                                       <ul class="pagination pagination-sm">
                                           <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                           <li class="page-item"><a href="#" class="page-link">1</a></li>
                                           <li class="page-item"><a href="#" class="page-link">2</a></li>
                                           <li class="page-item"><a href="#" class="page-link">3</a></li>
                                           <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                                       </ul>
                                   </div>
                               </div>
                               <!-- /.card-header -->
                               <div class="card-body">
                                   <ul class="todo-list">
                                       <li>
                                           <!-- drag handle -->
                                           <span class="handle">
                             <i class="fas fa-ellipsis-v"></i>
                             <i class="fas fa-ellipsis-v"></i>
                           </span>
                                           <!-- checkbox -->
                                           <input type="checkbox" value="" name="">
                                           <!-- todo text -->
                                           <span class="text">Design a nice theme</span>
                                           <!-- Emphasis label -->
                                           <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                                           <!-- General tools such as edit or delete-->
                                           <div class="tools">
                                               <i class="fas fa-edit"></i>
                                               <i class="far fa-trash-alt"></i>
                                           </div>
                                       </li>
                                       <li>
                           <span class="handle">
                             <i class="fas fa-ellipsis-v"></i>
                             <i class="fas fa-ellipsis-v"></i>
                           </span>
                                           <input type="checkbox" value="" name="">
                                           <span class="text">Make the theme responsive</span>
                                           <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                                           <div class="tools">
                                               <i class="fas fa-edit"></i>
                                               <i class="far fa-trash-alt"></i>
                                           </div>
                                       </li>
                                       <li>
                           <span class="handle">
                             <i class="fas fa-ellipsis-v"></i>
                             <i class="fas fa-ellipsis-v"></i>
                           </span>
                                           <input type="checkbox" value="" name="">
                                           <span class="text">Let theme shine like a star</span>
                                           <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                                           <div class="tools">
                                               <i class="fas fa-edit"></i>
                                               <i class="far fa-trash-alt"></i>
                                           </div>
                                       </li>
                                       <li>
                           <span class="handle">
                             <i class="fas fa-ellipsis-v"></i>
                             <i class="fas fa-ellipsis-v"></i>
                           </span>
                                           <input type="checkbox" value="" name="">
                                           <span class="text">Let theme shine like a star</span>
                                           <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                                           <div class="tools">
                                               <i class="fas fa-edit"></i>
                                               <i class="far fa-trash-alt"></i>
                                           </div>
                                       </li>
                                       <li>
                           <span class="handle">
                             <i class="fas fa-ellipsis-v"></i>
                             <i class="fas fa-ellipsis-v"></i>
                           </span>
                                           <input type="checkbox" value="" name="">
                                           <span class="text">Check your messages and notifications</span>
                                           <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                                           <div class="tools">
                                               <i class="fas fa-edit"></i>
                                               <i class="far fa-trash-alt"></i>
                                           </div>
                                       </li>
                                       <li>
                           <span class="handle">
                             <i class="fas fa-ellipsis-v"></i>
                             <i class="fas fa-ellipsis-v"></i>
                           </span>
                                           <input type="checkbox" value="" name="">
                                           <span class="text">Let theme shine like a star</span>
                                           <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                                           <div class="tools">
                                               <i class="fas fa-edit"></i>
                                               <i class="far fa-trash-alt"></i>
                                           </div>
                                       </li>
                                   </ul>
                               </div>
                               <!-- /.card-body -->
                               <div class="card-footer clearfix">
                                   <button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>
                               </div>
                           </div>
                           <!-- /.card -->
                       </section>
                       <!-- /.Left col -->
                       <!-- right col (We are only adding the ID to make the widgets sortable)-->
                       <section class="col-lg-5 connectedSortable">

                           <!-- Map card -->
                           <div class="card bg-primary-gradient">
                               <div class="card-header no-border">
                                   <h3 class="card-title">
                                       <i class="fas fa-map-marker-alt mr-1"></i>
                                       Visitors
                                   </h3>
                                   <!-- card tools -->
                                   <div class="card-tools">
                                       <button type="button"
                                               class="btn btn-primary btn-sm daterange"
                                               data-toggle="tooltip"
                                               title="Date range">
                                           <i class="far fa-calendar-alt"></i>
                                       </button>
                                       <button type="button"
                                               class="btn btn-primary btn-sm"
                                               data-widget="collapse"
                                               data-toggle="tooltip"
                                               title="Collapse">
                                           <i class="fas fa-minus"></i>
                                       </button>
                                   </div>
                                   <!-- /.card-tools -->
                               </div>
                               <div class="card-body">
                                   <div id="world-map" style="height: 250px; width: 100%;"></div>
                               </div>
                               <!-- /.card-body-->
                               <div class="card-footer bg-transparent">
                                   <div class="row">
                                       <div class="col-4 text-center">
                                           <div id="sparkline-1"></div>
                                           <div class="text-white">Visitors</div>
                                       </div>
                                       <!-- ./col -->
                                       <div class="col-4 text-center">
                                           <div id="sparkline-2"></div>
                                           <div class="text-white">Online</div>
                                       </div>
                                       <!-- ./col -->
                                       <div class="col-4 text-center">
                                           <div id="sparkline-3"></div>
                                           <div class="text-white">Sales</div>
                                       </div>
                                       <!-- ./col -->
                                   </div>
                                   <!-- /.row -->
                               </div>
                           </div>
                           <!-- /.card -->

                           <!-- solid sales graph -->
                           <div class="card bg-info-gradient">
                               <div class="card-header no-border">
                                   <h3 class="card-title">
                                       <i class="fas fa-th mr-1"></i>
                                       Sales Graph
                                   </h3>

                                   <div class="card-tools">
                                       <button type="button" class="btn bg-info btn-sm" data-widget="collapse">
                                           <i class="fas fa-minus"></i>
                                       </button>
                                       <button type="button" class="btn bg-info btn-sm" data-widget="remove">
                                           <i class="fas fa-times"></i>
                                       </button>
                                   </div>
                               </div>
                               <div class="card-body">
                                   <div class="chart" id="line-chart" style="height: 250px;"></div>
                               </div>
                               <!-- /.card-body -->
                               <div class="card-footer bg-transparent">
                                   <div class="row">
                                       <div class="col-4 text-center">
                                           <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                                                  data-fgColor="#39CCCC">

                                           <div class="text-white">Mail-Orders</div>
                                       </div>
                                       <!-- ./col -->
                                       <div class="col-4 text-center">
                                           <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                                                  data-fgColor="#39CCCC">

                                           <div class="text-white">Online</div>
                                       </div>
                                       <!-- ./col -->
                                       <div class="col-4 text-center">
                                           <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                                                  data-fgColor="#39CCCC">

                                           <div class="text-white">In-Store</div>
                                       </div>
                                       <!-- ./col -->
                                   </div>
                                   <!-- /.row -->
                               </div>
                               <!-- /.card-footer -->
                           </div>
                           <!-- /.card -->

                           <!-- Calendar -->
                           <div class="card bg-success-gradient">
                               <div class="card-header no-border">

                                   <h3 class="card-title">
                                       <i class="far fa-calendar-alt"></i>
                                       Calendar
                                   </h3>
                                   <!-- tools card -->
                                   <div class="card-tools">
                                       <!-- button with a dropdown -->
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                               <i class="fas fa-bars"></i></button>
                                           <div class="dropdown-menu float-right" role="menu">
                                               <a href="#" class="dropdown-item">Add new event</a>
                                               <a href="#" class="dropdown-item">Clear events</a>
                                               <div class="dropdown-divider"></div>
                                               <a href="#" class="dropdown-item">View calendar</a>
                                           </div>
                                       </div>
                                       <button type="button" class="btn btn-success btn-sm" data-widget="collapse">
                                           <i class="fas fa-minus"></i>
                                       </button>
                                       <button type="button" class="btn btn-success btn-sm" data-widget="remove">
                                           <i class="fas fa-times"></i>
                                       </button>
                                   </div>
                                   <!-- /. tools -->
                               </div>
                               <!-- /.card-header -->
                               <div class="card-body p-0">
                                   <!--The calendar -->
                                   <div id="calendar" style="width: 100%"></div>
                               </div>
                               <!-- /.card-body -->
                           </div>
                           <!-- /.card -->
                       </section>
                       <!-- right col -->
                   </div>
                   <!-- /.row (main row) -->
       --}}

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#expense_table').DataTable();
        });
        function printData(numVar) {
        $('#btn_print'+numVar).hide();
        var contentPrint = document.getElementById('print_portion'+numVar).innerHTML;
        var contentOrg = document.body.innerHTML;
        document.body.innerHTML = contentPrint;
        window.print();
        document.body.innerHTML = contentOrg;
        $('#btn_print'+numVar).show();
       
    }
    </script>
@stop

@section('plugin-css')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('plugin')
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-5.6.3-web/js/all.min.css') }}">
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
@stop
