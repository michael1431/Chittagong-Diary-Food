<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignQuotationIdUserIdRequisitionIdSupplierIdAtQuotationProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotation_products', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('requisition_id')->references('id')->on('requisitions');
            $table->foreign('requisition_product_id')->references('id')->on('requisition_products');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('quotation_id')->references('id')->on('quotations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotation_products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['requisition_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['quotation_id']);
            $table->dropForeign(['requisition_product_id']);
        });
    }
}
