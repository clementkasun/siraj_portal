<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reff_no',
        'full_name',
        'address',
        'phone_no_01',
        'phone_no_02',
        'nic',
        'passport_no',
        'passport_issue_date',
        'passport_place_of_issue',
        'passport_exp_date',
        'birth_date',
        'sex',
        'height',
        'weight',
        'complexion',
        'nationality',
        'religion',
        'maritial_status',
        'number_of_children',
        'applied_post',
        'applied_country',
        'post_status',
        'edu_qaulification',
        'monthly_sallary',
        'passport_pdf',
        'nic_pdf',
        'police_record_pdf',
        'gs_certificate_pdf',
        'family_back_pdf',
        'visa_pdf',
        'medical_pdf',
        'agreement_pdf',
        'personal_form_pdf',
        'job_order_pdf',
        'ticket_pdf',
        'applicant_image_passport',
        'applicant_image_full_size',
        'agency_agrement_pdf',
        'other_pdf',
        'hfform_pdf',
        'agency_agrement_pdf',
        'commision_price',
        'decorating',
        'baby_sitting',
        'cleaning',
        'cooking',
        'sewing',
        'washing',
        'driving',
        'added_by',
        'updated_by',
        'deleted_by'
    ];

    public $status = ['Pending', 'Working', 'Leaving'];

    public function ApplicantEducationalQualification()
    {
        return $this->hasMany(ApplicantEducationalQualification::class);
    }

    public function ApplicantLanguage()
    {
        return $this->hasMany(ApplicantLanguage::class);
    }

    public function ApplicantPreviousEmployeement()
    {
        return $this->hasMany(ApplicantPreviousEmployeement::class);
    }

    public function ApplicationStaffResponse()
    {
        return $this->hasMany(ApplicationStaffResponse::class);
    }

    public function Commission()
    {
        return $this->hasMany(Commission::class);
    }

    public $post_status_array = [
        ['name' => 'Registered', 'color' => '#48C9B0'],
        ['name' => 'Application Send', 'color' => '#F9E79F'],
        ['name' => 'Visa Granted', 'color' => '#2ECC71'],
        ['name' => 'Assign to Embassy', 'color' => '#9B59B6'],
        ['name' => 'Assign to Medical Test', 'color' => '#2E86C1'],
        ['name' => 'Assign to SLBFE Registration', 'color' => '#F4D03F'],
        ['name' => 'Ready to Dispatch', 'color' => '#229954'],
        ['name' => 'Dispatched', 'color' => '#117A65'],
        ['name' => 'Cancelled', 'color' => '#B03A2E'],
        ['name' => 'Returned the Passport', 'color' => '#641E16'],
    ];
}
