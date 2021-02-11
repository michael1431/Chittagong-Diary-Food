<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Route;
class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lebel')->nullable();
            $table->string('lebel_group')->nullable();
            $table->boolean('is_show_able')->default(1);
            $table->timestamps();
        });

        $routeName=[];
        $allRoutes = Route::getRoutes();
        //dd($allRoutes->nameList);
        foreach($allRoutes as $key=>$route){
            if($route->getName()){
                 $routeName[$key]['name']=$route->getName();
            }   
        }
        DB::table('permissions')->insert($routeName);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
