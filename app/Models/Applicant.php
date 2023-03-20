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
        'passport_exp_date',
        'birth_date',
        'sex',
        'weight',
        'complexion',
        'nationality',
        'religion',
        'maritial_status',
        'number_of_children',
        'applied_post',
        'applied_country',
        'post_status',
        'passport_pdf',
        'nic_pdf',
        'police_record_pdf',
        'gs_certificate_pdf',
        'family_back_pdf',
        'visa_pdf',
        'medical_pdf',
        'aggreement_pdf',
        'personal_form_pdf',
        'job_order_pdf',
        'ticket_pdf',
        'applicant_image',
        'aggency_aggrement_pdf',
        'commision_price',
        'decorating',
        'baby_sitting',
        'cleaning',
        'cooking',
        'sewing',
        'washing',
        'driving'
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
        return $this->belongsTo(Commission::class);
    }
}
