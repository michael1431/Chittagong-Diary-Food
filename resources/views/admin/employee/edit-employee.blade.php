@extends('layouts.fixed')

@section('title','Employee - Inventory CDF ')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Update Employee  </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Update Employee  </li>
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
                {{--create/edit start --}}
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <div class=" bg-light">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Update Employee  </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                {{ Form::model($employee,['route'=>'employee.update','method'=>'post','id'=>'CustomerForm','enctype'=>'multipart/form-data']) }}

                                <div class="col-lg-12 col-sm-12 {{$errors->has('name') ? 'has-error' : ''}}">
                                    {{ Form::hidden('id',$employee->id,['class'=>'form-control','id'=>'id']) }}
                                    {{ Form::label('Customername','Name : ',['class'=>'control-label'])}}
                                    {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Ex: Customer Name','id'=>'name'])}}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>

                                <div class="col-lg-12 col-sm-12 {{$errors->has('father') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Salary : ',['class'=>'control-label'])}}
                                    {{ Form::text('salary',old('salary'),['class'=>'form-control','placeholder'=>'Ex: 2000 tk','id'=>'name'])}}
                                    @if ($errors->has('salary'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('salary') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>


                                <div class="col-lg-12 col-sm-12 {{$errors->has('father') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Father : ',['class'=>'control-label'])}}
                                    {{ Form::text('father',old('father'),['class'=>'form-control','placeholder'=>'Ex: Customer Name','id'=>'name'])}}
                                    @if ($errors->has('father'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('father') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>


                                <div class="col-lg-12 col-sm-12 {{$errors->has('mother') ? 'has-error' : ''}}">
                                    {{ Form::label('Mother','Mother : ',['class'=>'control-label'])}}
                                    {{ Form::text('mother',old('mother'),['class'=>'form-control','placeholder'=>'Ex: Mother Name','id'=>'name'])}}
                                    @if ($errors->has('mother'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('mother') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>


                                <div class="col-lg-12 col-sm-12 {{$errors->has('wife') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Wife : ',['class'=>'control-label'])}}
                                    {{ Form::text('wife',old('wife'),['class'=>'form-control','placeholder'=>'Ex: wife Name','id'=>'name'])}}
                                    @if ($errors->has('wife'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('wife') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>


                                <div class="col-lg-12 col-sm-12 {{$errors->has('nid') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','NID : ',['class'=>'control-label'])}}
                                    {{ Form::text('nid',old('nid'),['class'=>'form-control','placeholder'=>'Ex: 123456789101245','id'=>'name'])}}
                                    @if ($errors->has('nid'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('nid') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-sm-12 {{$errors->has('email') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Email : ',['class'=>'control-label'])}}
                                    {{ Form::text('email',$employee->user ? $employee->user->email : null,['class'=>'form-control','placeholder'=>'Ex: employee@gmail.com','id'=>'email'])}}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-sm-12 {{$errors->has('password') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Password : ',['class'=>'control-label'])}}
                                    {{ Form::text('password',old('password'),['class'=>'form-control','placeholder'=>'Ex: 123456789101245','id'=>'name'])}}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-sm-12 {{$errors->has('password') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Role : ',['class'=>'control-label'])}}
                                    <select name="role" id="role">
                                        @forelse ($roles as $role)
                                                <option value="{{ $role->id }}" {{ ($employee->user ?($role->id==$employee->user->role_id ?'selected':''):'') }}>{{ $role->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif
                                    <hr>
                                </div>

                                <div class="col-lg-12 col-sm-12 {{$errors->has('phone1') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Phone 1 : ',['class'=>'control-label'])}}
                                    {{ Form::text('phone1',old('phone1'),['class'=>'form-control','placeholder'=>'Ex: Customer Name','id'=>'name'])}}
                                    @if ($errors->has('phone1'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('phone1') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>


                                <div class="col-lg-12 col-sm-12 {{$errors->has('phone2') ? 'has-error' : ''}}">
                                    {{ Form::label('Customername','Phone 2 : ',['class'=>'control-label'])}}
                                    {{ Form::text('phone2',old('phone2'),['class'=>'form-control','placeholder'=>'Ex: Customer Name','id'=>'name'])}}
                                    @if ($errors->has('phone2'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('phone2') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>

                                <div class="col-lg-12 col-sm-12 {{$errors->has('image') ? 'has-error' : ''}}">

                                    {{ Form::label('Customerimage','Image : ',['class'=>'control-label'])}}
                                    {{ Form::file('image',old('image'),['class'=>'form-control','required'])}}
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                    <hr>
                                </div>


                                <div class="col-lg-12 col-sm-12 {{$errors->has('image') ? 'has-error' : ''}}">

                                    {{ Form::label('Customerimage','Old Image : ',['class'=>'control-label'])}}

                                    <img src="{{ asset('public/admin/product/upload/'.$employee->image) }}" alt="no image found" style="height: 80px;width: 80px;">

                                    <hr>
                                </div>



                                <div class="col-lg-12 col-sm-12 {{$errors->has('address') ? 'has-error' : ''}}">

                                    {{ Form::label('Customeraddress','Address : ',['class'=>'control-label'])}}
                                    {{ Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Ex: Customer Address','id'=>'address'])}}
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="col-md-12 col-xs-12">
                                    <br>
                                </div>

                                <div class="col-md-12 col-xs-12">
                                    {{ Form::button('UPDATE',['type'=>'submit','id'=>'saveCustomer','class'=>'btn btn-primary']) }}
                                    {{ Form::hidden('canceledit',"Cancel Edit",['type'=>'reset','id'=>'cancel','class'=>'btn btn-danger']) }}
                                    <a href="{{ route('employee.add') }}" class="fa fa-pencil btn btn-danger">Cancel</a>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
                {{--create/edit  start --}}

                {{--list  start --}}
                {{-- <div class="col-md-8">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-info">Inventory Employee list </h5>
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
                            <table class="table table-bordered table-striped" id="brandTable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Father </th>
                                    <th>Mother </th>
                                    <th>Wife </th>
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
                                        <td id="name{{ $info->id }}" data-id="{{ $info->wife }}">{{$info->wife}}</td>
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
                                            <a class="btn btn-sm btn-info edit" data-id="{{ $info->id }}" href="{{ route('employee.edit',$info->id) }}"><i class="demo-pli-pen-5"></i></a> ||
                                            <button class="btn btn-sm btn-danger erase" data-id="{{$info->id}}" data-url="{{url('Employee/erase')}}">
                                                <i class="demo-pli-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div> --}}
                {{--list end--}}

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
  <script>
    </script>
@stop