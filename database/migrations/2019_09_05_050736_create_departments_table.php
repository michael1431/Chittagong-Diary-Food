<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        DB::table('departments')->insert([
            [
            'name' => 'Sales',
            'description' => 'Product that used for Sale Purpose'
            ],
            [
            'name' => 'Gift',
            'description' => 'Product that used for Gift Purpose'
            ],
            [
            'name' => 'Stationaries',
            'description' => 'Product that used for Stationaries Purpose'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
