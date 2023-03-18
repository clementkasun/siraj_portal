<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePrivillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_privillages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id')->unsigned();
            $table->unsignedBigInteger('privillage_id')->unsigned();
            $table->boolean('is_read')->unsigned();
            $table->boolean('is_create')->unsigned();
            $table->boolean('is_update')->unsigned();
            $table->boolean('is_delete')->unsigned();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('privillage_id')->references('id')->on('privillages')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['role_id','privillage_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_privillages');
    }
}
