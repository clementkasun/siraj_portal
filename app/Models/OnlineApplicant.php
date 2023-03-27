<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineApplicant extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'applicant_name',
        'passport_number',
        'nic',
        'birth_date',
        'address',
        'phone_no_01',
        'phone_no_02',
        'job_type'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function OnlineApplicantResponse()
    {
        return $this->hasMany(OnlineApplicantResponse::class);
    }
}
