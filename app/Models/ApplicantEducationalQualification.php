<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantEducationalQualification extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institute',
        'course',
        'start_date',
        'end_date',
        'result',
        'applicant_id'
    ];

    public function Applicant(){
        return $this->belongsTo(Applicant::class);
    }
}
