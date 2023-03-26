<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name', 'level_id'];

    public function  Level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function User()
    {
        return $this->hasMany(User::class);
    }

    public function RolePrivillage()
    {
        return  $this->hasMany(RolePrivillage::class, 'role_id');
    }

    public function ApplicationStaffResponse()
    {
        return  $this->hasMany(ApplicationStaffResponse::class);
    }

    public function PhoneNumberResponse()
    {
        return $this->hasMany(PhoneNumberResponse::class);
    }
}
