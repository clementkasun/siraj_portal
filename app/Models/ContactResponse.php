<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactResponse extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'designation',
        'response',
        'contact_id',
    ];

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }

    public function Designation(){
        return $this->belongsTo(Role::class, 'designation');
    }
}
