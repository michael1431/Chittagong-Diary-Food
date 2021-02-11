<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_processed_by')->nullable();//User ID
            $table->unsignedBigInteger('order_by')->nullable();//User ID of marketing
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->integer('qty')->nullable();
            $table->double('price')->nullable();
            $table->double('emp_commission')->nullable();//as like as discount
            $table->double('mar_commission')->nullable();//as like as discount
            $table->text('note')->nullable();
            //$table->text('custom_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
