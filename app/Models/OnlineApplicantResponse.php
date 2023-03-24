<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineApplicantResponse extends Model
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
        'online_applicant_id'
    ];

    public function OnlineApplicant()
    {
        return $this->belongsTo(OnlineApplicant::class);
    }
}
