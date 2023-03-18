<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_responses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('designation', 255);
            $table->string('response', 255);
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_responses');
    }
}
