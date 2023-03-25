<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneNumber extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_number',
        'name',
        'added_by',
        'assigned_staff_member',
    ];

    public function PhoneNumberResponse()
    {
        return $this->hasMany(PhoneNumberResponse::class);
    }

    public function AddedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function AssignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_staff_member');
    }
}
