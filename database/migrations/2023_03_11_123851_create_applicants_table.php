<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('reff_no', 255)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('phone_no_01', 12)->nullable();
            $table->string('phone_no_02', 12)->nullable();
            $table->string('nic', 25);
            $table->string('passport_no', 255)->nullable();
            $table->string('passport_issue_date', 255)->nullable();
            $table->string('passport_place_of_issue', 255)->nullable();
            $table->string('passport_exp_date', 255)->nullable();
            $table->string('birth_date', 255)->nullable();
            $table->boolean('sex')->nullable();
            $table->string('height', 20)->nullable();
            $table->string('weight', 5)->nullable();
            $table->string('complexion', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->string('maritial_status', 255)->nullable();
            $table->string('number_of_children', 255)->nullable();
            $table->string('applied_country', 255)->nullable();
            $table->string('applied_post', 255)->nullable();
            $table->string('edu_qaulification', 255)->nullable();
            $table->tinyInteger('post_status')->nullable();
            $table->string('monthly_sallary', 255)->nullable();
            $table->boolean('decorating')->nullable();
            $table->boolean('baby_sitting')->nullable();
            $table->boolean('cleaning')->nullable();
            $table->boolean('cooking')->nullable();
            $table->boolean('sewing')->nullable();
            $table->boolean('washing')->nullable();
            $table->boolean('driving')->nullable();
            $table->string('passport_pdf', 255)->nullable();
            $table->string('nic_pdf', 255)->nullable();
            $table->string('police_record_pdf', 255)->nullable();
            $table->string('gs_certificate_pdf', 255)->nullable();
            $table->string('family_back_pdf', 255)->nullable();
            $table->string('visa_pdf', 255)->nullable();
            $table->string('medical_pdf', 255)->nullable();
            $table->string('agreement_pdf', 255)->nullable();
            $table->string('personal_form_pdf', 255)->nullable();
            $table->string('job_order_pdf', 255)->nullable();
            $table->string('ticket_pdf', 255)->nullable();
            $table->string('agency_agreement_pdf', 255)->nullable();
            $table->string('other_pdf', 255)->nullable();
            $table->string('hform_pdf', 255)->nullable();
            $table->string('applicant_image_passport', 255)->nullable();
            $table->string('applicant_image_full_size', 255)->nullable();
            $table->string('commision_price', 255)->nullable();//promissed commission price
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
        Schema::dropIfExists('applicants');
    }
}
