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
        'designation',
        'price',
        'response',
        'applicant_id',
        'added_by',
        'updated_by',
        'deleted_by'
    ];

    public function Applicant(){
        return $this->belongsTo(Applicant::class);
    }

    public function Designation(){
        return $this->belongsTo(Role::class, 'designation');
    }

    public function AddedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
