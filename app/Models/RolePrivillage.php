<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePrivillage extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id ',
        'privillage_id',
        'is_create',
        'is_read',
        'is_update',
        'is_delete',
    ];

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }

    public function Privillage(){
        return $this->belongsTo(Privillage::class);
    }

}
