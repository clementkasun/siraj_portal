<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_name',
        'email',
        'companey_name',
        'phone_number',
        'subject',
        'file',
        'message'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function ContactResponse(){
        return $this->hasMany(ContactResponse::class);
    }
}
