@extends('layouts.fixed')
@section('title','Goods in  - CDF ')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage  LC Report </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage LC Report </li>
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
                <div class="col-lg-12">
                    <div class=" bg-light">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit Inventory LC Report </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->

                            

                        <div class="card-body">

							<form action="{{ route('lc.update', $edit->id) }}" method="post">

							@csrf

						    @include('messages')
								<div class="col-md-4">
									
								
									<div class="form-group">

										<label for="name">LC NO</label>
										<input type="text"  class="form-control" name="lc_no" value="{{ $edit->lc_no }}">

									</div>

									<div class="form-group">
										<label for="cost">Cost Type</label>
										<select id="cost" name="cost_id" class="form-control">
											<option value="" @if($edit->cost_id == "") selected @endif>purchase</option>
											@foreach($costs as $cost)
												<option value="{{ $cost->id}}" @if($edit->cost_id == $cost->id) selected @endif>{{ $cost->name }}</option>
											@endforeach
										</select>
									

									</div>


									<div class="form-group">
										
									<label for="name">Amount</label>
									<input type="text" class="form-control"  name="total_amount" value="{{ number_format($edit->total_amount,2) }}">

									</div>
								</div>

								<input type="submit" name="submit" value="Update Information" class="btn btn-success">
							  </form>
					
						

					      </div>
			


                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--create/edit  start --}}



            </div>
        </div>
    </section><!-- /.content -->
@stop

@section('script')
    <!-- page script -->
  
@stop