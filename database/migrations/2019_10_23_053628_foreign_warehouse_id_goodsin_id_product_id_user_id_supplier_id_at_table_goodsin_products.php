<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignWarehouseIdGoodsinIdProductIdUserIdSupplierIdAtTableGoodsinProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goodsin_products', function (Blueprint $table) {
            // $table->foreign('warehouse_id')->references('id')->on('warehouses');
            // $table->foreign('goodsin_id')->references('id')->on('goodsins');
            // $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('supplier_id')->references('id')->on('suppliers');
            // $table->foreign('requisition_id')->references('id')->on('requisitions');
            // $table->foreign('quotation_id')->references('id')->on('quotations');
            // $table->foreign('purchase_id')->references('id')->on('purchases');
            // $table->foreign('department_id')->references('id')->on('departments');
            // $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goodsin_products', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropForeign(['goodsin_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['requisition_id']);
            $table->dropForeign(['quotation_id']);
            $table->dropForeign(['purchase_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['group_id']);
        });
    }
}
