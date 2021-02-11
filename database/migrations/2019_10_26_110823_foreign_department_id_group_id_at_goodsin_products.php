<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignDepartmentIdGroupIdAtGoodsinProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goodsin_products', function (Blueprint $table) {
            // $table->foreign('department_id')->references('id')->on('departments');
            // $table->foreign('group_id')->references('id')->on('groups');
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
            $table->dropForeign(['department_id']);
            $table->dropForeign(['group_id']);
        });
    }
}
