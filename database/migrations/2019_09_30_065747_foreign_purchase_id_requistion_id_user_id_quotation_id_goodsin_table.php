<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignPurchaseIdRequistionIdUserIdQuotationIdGoodsinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goodsins', function (Blueprint $table) {
            $table->foreign('purchase_id')->references('id')->on('purchases');
            $table->foreign('quotation_id')->references('id')->on('quotations');
            $table->foreign('requisition_id')->references('id')->on('requisitions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goodsins', function (Blueprint $table) {
            $table->dropForeign(['purchase_id']);
            $table->dropForeign(['quotation_id']);
            $table->dropForeign(['requisition_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
