<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name', 255);
            $table->string('passport_number', 50);
            $table->string('nic', 255);
            $table->string('birth_date', 20);
            $table->string('address', 255);
            $table->string('phone_no_01', 255);
            $table->string('phone_no_02', 255);
            $table->string('job_type', 255);
            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('online_applicants');
    }
}
