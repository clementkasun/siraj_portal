<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
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
        'price',
        'response',
        'applicant_id',
        'added_by'
    ];

    public function Applicant(){
        return $this->belongsTo(Applicant::class);
    }

    public function Designation(){
        return $this->belongsTo(Role::class, 'designation');
    }
}
