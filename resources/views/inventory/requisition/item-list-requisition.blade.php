<div class="table-responsive">

    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr class="bg-info">
                <td> #SL</td>
                <td> Department</td>
                <td> Group</td>
                <td> Code</td>
                <td> Name</td>
                <td> Unit</td>
                <td> Price</td>
                <td> Cur Stock</td>
                <td> 2 Months Consum.</td>
                <td> Qty</td>
                <td> Last Purchase </td>
                <td> Remarks</td>
                <td> Action </td>
            </tr>
        </thead>

        <tbody class="bodyItem" id="requisition_items">
            <tr>
                <td colspan="12" class=" bg-danger text-center"> No Requisition Product found</td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>
    <br>

</div>

{{--

@section('script')
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

    </script>
@stop--}}
