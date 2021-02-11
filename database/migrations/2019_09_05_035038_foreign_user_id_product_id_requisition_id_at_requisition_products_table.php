<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignUserIdProductIdRequisitionIdAtRequisitionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisition_products', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('requisition_id')->references('id')->on('requisitions');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisition_products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['requisition_id']);
            $table->dropForeign(['product_id']);
        });
    }
}
