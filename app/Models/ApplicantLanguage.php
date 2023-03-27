<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantLanguage extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_name',
        'poor',
        'fair',
        'fluent',
        'applicant_id',
        'added_by',
        'updated_by',
        'deleted_by'
    ];

    public function Applicant(){
        return $this->belongsTo(Applicant::class);
    }
}
