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
        'online_applicant_id',
        'added_by'
    ];

    public function OnlineApplicant()
    {
        return $this->belongsTo(OnlineApplicant::class);
    }

    public function Designation()
    {
        return $this->belongsTo(Role::class, 'designation');
    }

    public function AddedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
