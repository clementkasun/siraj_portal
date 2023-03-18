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
        'firstname',
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
        'status'
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

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    public function Role() {
        return $this->belongsTo(Role::class);
    }

    // public function privileges() {
    //     return $this->belongsToMany(Privilege::class)->withPivot('is_read', 'is_create', 'is_update', 'is_delete');
    // }
    
    // public function authentication($id) {
    //     $pre = $this->privileges;
    //     foreach ($pre as $p) {
    //         if ($p['id'] == $id) {
    //             return $p['pivot'];
    //         }
    //     }
    //     return null;
    // }

    // public function hasPrivillage($privilege){
    //     return null !== $this->privilege()->where('name', $privilege)->first();
    // }

    // public function Contact(){
    //     return $this->hasOne('Contact');
    // }

    // public function Vacancy(){
    //     return $this->hasMany('Vacancy');
    // }

}
