<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationStaffResponse extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_mem_name',
        'designation',
        'response',
        'applicant_id'
    ];

    public function Applicant(){
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

    public function designation(){
        return $this->belongsTo(Role::class, 'designation');
    }
}
