<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentIdGroupIdTableGoodsinProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goodsin_products', function (Blueprint $table) {
            // $table->unsignedBigInteger('department_id')->nullable();
            // $table->unsignedBigInteger('group_id')->nullable();
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
            $table->dropColumn(['department_id']);
            $table->dropColumn(['group_id']);
        });
    }
}
