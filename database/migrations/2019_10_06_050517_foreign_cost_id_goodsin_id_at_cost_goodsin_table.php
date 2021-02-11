<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignCostIdGoodsinIdAtCostGoodsinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_goodsin', function (Blueprint $table) {
            // $table->foreign('cost_id')->references('id')->on('costs');
            // $table->foreign('goodsin_id')->references('id')->on('goodsins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_goodsin', function (Blueprint $table) {
            $table->dropForeign(['cost_id']);
            $table->dropForeign(['goodsin_id']);
        });
    }
}
