<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostGoodsinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('expense', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('cost_id');
        //     $table->string('invoice_no')->nullable();
        //     $table->string('lc_no')->nullable();
        //     $table->double('qty')->nullable();
        //     $table->double('price')->nullable();
        //     $table->double('amount');
        //     $table->longText('note')->nullable();
        //     $table->timestamps();

        //     $table->foreign('cost_id')->references('id')->on('costs');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_goodsin');
    }
}
