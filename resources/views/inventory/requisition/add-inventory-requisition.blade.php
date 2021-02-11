@extends('layouts.fixed')

@section('title','Save-Item Inventory')

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
                    <h1>Manage Requisition</h1>
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

                        {{-- requisition items lists start --}}
                        <div class="col-lg-12 table-responsive">
                            <h4 class="bg-info text-center" style="padding: 10px;">List of Requisition Item's</h4>
                            @include('inventory.requisition.item-list-requisition')
                            <div class="form-group">
                                {{ Form::label('','Note / Description   ') }}
                                {{ Form::textarea('description',null,['class'=>'form-control confirmationNote','rows'=>5,'cols'=>10,'placeholder'=>'Purchase Requisition note ']) }}
                            </div>
                            <div class="col-lg-3 col-sm-3">
                                <div class="form-group">
                                    {{ Form::button("Confirm Requisition",['class'=>'form-control btn btn-info btn-block confirmRequisition']) }}
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                        {{-- requisition items lists End --}}

                        {{-- Requisition items add form Start --}}
                        <div class="col-lg-12 table-responsive">
                            
                            <h4 class="bg-info text-center" style="padding: 10px;">Item Add Form</h4>
                            <div class="loader"></div>
                            @include('inventory.requisition.procedure-form')


                        </div>
                        {{-- Requisition items add form End--}}

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
        $(document).ready(function () {
            pendingProducts();
        });

        /* pending product list start */
        function pendingProducts() {
            $.ajax({
                method:"get",
                url:"{{ route('inventory.requisition.pending.products') }}",
                dataType:"html",
                success:function (response) {
                    $("#requisition_items").html(response);
                }
            })
        }
        /* pending product list end */


        /* filter according to Product Code Start */

        $(document).on('change','#product_id',function () {
            var id = $(this).val();
            if(id !=null){
                $.ajax({
                    method:"post",
                    url:"{{ route('inventory.item.info') }}",
                    data: {id:id, _token:"{{ csrf_token() }}"},
                    dataType:'json',
                    success:function (response) {
                        $("#unit").val(response.unit);
                        $("#price").val(response.price);
                    }
                });
            }
        });

        /* filter according to Product Code End */

        /* store requisition at TempData Start*/
        $(document).on('click','.storeRequestRequisition',function () {

            
            var product_id = $("#product_id").val();
            var price = $("#price").val();
            var qty = $('#qty').val();
            var note = $("#note").val();

            if(product_id =="Select Code/Name" || price =='' || qty ==''){

                $("#qty").css({"background":"#DC4C40","color":"#fff"});
                $("#price").css({"background":"#DC4C40","color":"#fff"});
            }else{
                $('.loader').show();
                $.ajax({

                    method:"post",
                    url:"{{ route('inventory.purchase.temp.store') }}",
                    data : {product_id:product_id,price:price,type:1,qty:qty,note:note, _token:"{{ csrf_token() }}"},
                    dataType:"json",
                    success:function (res) {
                        pendingProducts();
                        if(res.success == 1){
                            $('.loader').hide();
                            $.notify("Product / Item Added to Requisition List", {globalPosition: 'bottom center',className: 'success'});

                        }
                        
                        $("#unit").val(null);
                        $("#price").val(null);
                        $('#qty').val(null);
                        $('#note').val(null);
                    }
                });
            }
        });
        /* store requisition at TempData End */



        /* Requisition Confirmation Start */
        $(document).on("click",".confirmRequisition",function () {
            var note = $('.confirmationNote').val();
            var token  = "{{ csrf_token() }}";
            $.ajax({
                method:"post",
                url : "{{ route('inventory.store.requisition') }}",
                data:{ note:note, _token:token},
                dataType:"json",
                success:function (res) {
                    if (res.success == 1){
                        pendingProducts();
                        $.notify("Purchase Requisition successfully created", {globalPosition: 'bottom center',className: 'success'});
                        $('.confirmationNote').val(null);
                    }
                }
            });

        });
        /* Requisition Confirmation End */





    </script>

@stop
