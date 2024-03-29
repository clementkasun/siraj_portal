<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privillage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];

    public function PrivillageRole(){
        return $this->hasMany(PrivillageRole::class);
    }
}
