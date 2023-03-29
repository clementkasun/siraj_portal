<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

    use SoftDeletes;
    use HasApiTokens;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public const ACTIVE = 'Active';
    public const INACTIVE = 'Inactive';
    public const ARCHIVED = 'Archived';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'preffered_name',
        'mobile_no',
        'land_no',
        'nic',
        'birth_date',
        'nic_front_image',
        'nic_back_image',
        'user_image',
        'email',
        'address',
        'password',
        'role_id',
        'status',
        'added_by',
        'updated_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function Role() {
        return $this->belongsTo(Role::class);
    }

    public function BlogPost()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function OnlineApplicant()
    {
        return $this->belongsTo(OnlineApplicant::class);
    }

    public function PhoneNumber()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    public function ApplicantPreviousEmployeeDetails()
    {
        return $this->hasMany(ApplicantPreviousEmployeement::class);
    }

    public function PhoneNumberResponse()
    {
        return $this->hasMany(PhoneNumberResponse::class);
    }

    public function OnlineApplicantResponse()
    {
        return $this->hasMany(OnlineApplicantResponse::class);
    }

    public function Commission()
    {
        return $this->hasMany(Commission::class);
    }
}
