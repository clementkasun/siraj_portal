<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_name',
        'address',
        'phone_number',
        'passport_number',
        'birth_day',
        'job_type',
        'country'
    ];

    public function CandidateResponse(){
        return $this->hasMany(CandidateResponse::class);
    }
}
