<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_number',
        'msg',
        'graduate_id',
        'send_id',
        'deliver_code'
    ];

    public function graduates()
    {
        return $this->belongsTo(Graduate::class);
    }
}
