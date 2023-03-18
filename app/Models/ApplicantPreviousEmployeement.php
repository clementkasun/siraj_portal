<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantPreviousEmployeement extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_type',
        'period',
        'monthly_salary',
        'contract_period',
        'country',
        'applicant_id'
    ];

    public function Applicant(){
        return $this->belongsTo(Applicant::class);
    }
}
