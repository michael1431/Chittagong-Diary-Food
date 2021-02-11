@extends('layouts.fixed')

@section('title','Employee - Inventory CDF ')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage  Employee  </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Employee  </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-info">Inventory Employee list </h5>
                                <p> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add New Employee
                                  </button></p>
                            </div>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered table-striped" id="productTable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Father </th>
                                    <th>Mother </th>
                                    <th>Email </th>
                                    <th>Nid </th>
                                    <th>Phone1 </th>
                                    <th>Salary </th>
                                    <th>Image </th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=0; @endphp
                                @foreach($employees as $info)
                                    <tr id="rowid{{$info->id}}" class="abcd">
                                        <td>{{++$i}}</td>
                                        <td id="name{{ $info->id }}" data-id="{{ $info->name }}">{{$info->name}}</td>
                                        <td id="name{{ $info->id }}" data-id="{{ $info->father }}">{{$info->father}}</td>
                                        <td id="name{{ $info->id }}" data-id="{{ $info->mother }}">{{$info->mother}}</td>
                                        <td id="name{{ $info->id }}" data-id="{{$info->user ? $info->user->email :'' }}">{{$info->user ? $info->user->email :'Access not Given' }}</td>
                                        <td id="name{{ $info->id }}" data-id="{{ $info->nid }}">{{$info->nid}}</td>
                                        <td id="name{{ $info->id }}" data-id="{{ $info->phone1 }}">{{$info->phone1}}</td>
                                        <td id="phone{{ $info->id }}" data-id="{{ $info->salary }}">{{$info->salary}}</td>
                                        <td id="phone{{ $info->id }}" data-id="{{ $info->image }}"><img src="{{ asset('public/admin/employee/upload/'.$info->image) }}" style="height: 60px;width: 60px;"></td>
                                        <td id="address{{ $info->id }}" data-id="{{ $info->address }}">
                                            @if(!empty($info->address))
                                                {{ substr($info->address,0,10) }}
                                            @else
                                                <p class="text-center">no address</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info edit" data-id="{{ $info->id }}" href="{{ route('employee.edit',$info->id) }}"><i class="fa fa-pen"></i></a> ||
                                            <button class="btn btn-sm btn-danger erase" data-id="{{$info->id}}" data-url="{{url('Employee/erase')}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            ||<a href="{{ route('parties.status',['type'=>'Customer','related_party'=>$info->user_id]) }}" class="btn btn-success">Ledger</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                {{--list end--}}

            </div>
        </div>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Add Employee</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    {{ Form::open(['route'=>'employee.store','method'=>'post','id'=>'EmployeeForm','enctype'=>'multipart/form-data']) }}
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 {{$errors->has('name') ? 'has-error' : ''}}">
                            {{ Form::hidden('id',null,['class'=>'form-control','id'=>'id']) }}
                            {{ Form::label('Employeename','Name : ',['class'=>'control-label'])}}
                            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Ex: Employee Name','id'=>'name'])}}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        
                        </div>
                    </div>
                   

                    

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 {{$errors->has('father') ? 'has-error' : ''}}">
                            {{ Form::label('Employeename','Father : ',['class'=>'control-label'])}}
                            {{ Form::text('father',old('father'),['class'=>'form-control','placeholder'=>'Ex: Father Name','id'=>'father'])}}
                            @if ($errors->has('father'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father') }}</strong>
                                </span>
                            @endif
                           
                        </div>


                        <div class="col-lg-4 col-sm-4 {{$errors->has('mother') ? 'has-error' : ''}}">
                            {{ Form::label('Mother','Mother : ',['class'=>'control-label'])}}
                            {{ Form::text('mother',old('mother'),['class'=>'form-control','placeholder'=>'Ex: Mother Name','id'=>'mother'])}}
                            @if ($errors->has('mother'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother') }}</strong>
                                </span>
                            @endif
                          
                        </div>


                        <div class="col-lg-4 col-sm-4 {{$errors->has('wife') ? 'has-error' : ''}}">
                            {{ Form::label('Employeename','Wife : ',['class'=>'control-label'])}}
                            {{ Form::text('wife',old('wife'),['class'=>'form-control','placeholder'=>'Ex: wife Name','id'=>'name'])}}
                            @if ($errors->has('wife'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('wife') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 {{$errors->has('salary') ? 'has-error' : ''}}">
                            {{ Form::label('Employeename','Salary : ',['class'=>'control-label'])}}
                            {{ Form::text('salary',old('salary'),['class'=>'form-control','placeholder'=>'Ex: Salary','id'=>'salary'])}}
                            @if ($errors->has('salary'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-lg-4 col-sm-4 {{$errors->has('nid') ? 'has-error' : ''}}">
                            {{ Form::label('Employeename','NID : ',['class'=>'control-label'])}}
                            {{ Form::text('nid',old('nid'),['class'=>'form-control','placeholder'=>'Ex: 6345678910645','id'=>'name'])}}
                            @if ($errors->has('nid'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nid') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        <div class="form-group col-lg-4 col-sm-4 {{$errors->has('image') ? 'has-error' : ''}}">

                                {{ Form::label('Employeeimage','Image : ',['class'=>'control-label'])}}
                                <input type="file" name="image" id="image" class="form-control">
                                {{-- {{ Form::file('image',old('image'),['class'=>'form-control','required'])}} --}}
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                         <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 {{$errors->has('phone1') ? 'has-error' : ''}}">
                            {{ Form::label('Customername','Phone 1 : ',['class'=>'control-label'])}}
                            {{ Form::text('phone1',old('phone1'),['class'=>'form-control','placeholder'=>'Ex: Employee Phone 1','id'=>'name'])}}
                            @if ($errors->has('phone1'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone1') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        


                        <div class="col-lg-4 col-sm-4 {{$errors->has('phone2') ? 'has-error' : ''}}">
                            {{ Form::label('Employeename','Phone 2 : ',['class'=>'control-label'])}}
                            {{ Form::text('phone2',old('phone2'),['class'=>'form-control','placeholder'=>'Ex: Employee Phone 2','id'=>'name'])}}
                            @if ($errors->has('phone2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone2') }}</strong>
                                </span>
                            @endif
                        
                        </div>
                        <div class="col-lg-4 col-sm-4 {{$errors->has('phone1') ? 'has-error' : ''}}">
                            {{ Form::label('Customername','Role : ',['class'=>'control-label'])}}
                           <select name="role" id="role">
                               @forelse ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                               @empty
                                   
                               @endforelse
                           </select>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-6 {{$errors->has('email') ? 'has-error' : ''}}">
                            {{ Form::label('Employeename','Email : ',['class'=>'control-label'])}}
                            {{ Form::email('email',null,['class'=>'form-control','placeholder'=>'Ex: Employee Email To give login Access','id'=>'email'])}}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 {{$errors->has('password') ? 'has-error' : ''}}">
                            {{ Form::label('Employeename','Password : ',['class'=>'control-label'])}}
                            <input type="password" name="password" id="password" class="form-control">
                            {{-- {{ Form::password('password',null,['class'=>'form-control','id'=>'password'])}} --}}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                    </div>
                


                    <div class="row">
                        <div class="col-lg-12 col-sm-12 {{$errors->has('address') ? 'has-error' : ''}}">

                            {{ Form::label('Employeeaddress','Address : ',['class'=>'control-label'])}}
                            {{ Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Ex: Employee Address','id'=>'address','rows'=>'3'])}}
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                   

                   
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    
                        {{ Form::button('SAVE',['type'=>'submit','id'=>'saveCustomer','class'=>'btn btn-primary']) }}
                        {{ Form::hidden('canceledit',"Cancel Edit",['type'=>'reset','id'=>'cancel','class'=>'btn btn-danger']) }}
                   
                    {{ Form::close() }}
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
              </div>
            </div>
          </div>

    </section><!-- /.content -->
@stop

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
@stop

@section('plugin')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script>
@stop

@section('script')
    <!-- page script -->
    <script type="text/javascript">
        var table;
        $(document).ready(function () {
            $('#productTable').dataTable();
        });
    </script>
@stop