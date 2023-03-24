<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneNumberResponse extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'response',
        'designation',
        'phone_number_id'
    ];

    public function PhoneNumber()
    {
        return $this->belongsTo(PhoneNumber::class, 'phone_number_id');
    }

    public function Designation()
    {
        return $this->belongsTo(Role::class, 'designation');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
