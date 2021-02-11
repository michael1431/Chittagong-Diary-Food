<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->string('lc_no')->nullable();
            $table->unsignedBigInteger('related_party_id')->nullable(); // supplier | employee | cost |
            $table->string('related_party_type')->nullable(); // supplier | employee | cost | gift 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cost_id')->nullable();
            $table->double('total_amount');
            $table->double('total_return')->nullable();
            $table->double('total_less')->nullable();
            $table->double('total_paid')->nullable();
            $table->double('total_balance')->nullable();
            $table->double('total_discount')->nullable();
            $table->boolean('discount_type')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_trxid')->nullable();
            $table->string('note')->nullable();
            $table->boolean('status')->nullable();
            $table->string('event')->nullable();
            $table->timestamps();
            $table->foreign("user_id")->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
