<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
        DB::table('company_information')->insert([
            'company_name' => 'Company Name',
            'address' => 'A Address Here',
            'email' => 'company@gmail.com',
            'logo_url' => 'public/company_logo.jpg',
            'phone' => '018XX XXXXXX',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_information');
    }
}
