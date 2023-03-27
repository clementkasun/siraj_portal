<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'salary',
        'period',
        'location',
        'vacancy_image',
        'added_by',
        'updated_by',
        'deleted_by'
    ];

    public function User(){
        return $this->belongsTo('User');
    }
}
