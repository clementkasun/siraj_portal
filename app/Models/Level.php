<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public const Admin = 'Admin';
    public const Manager = 'Manager';
    public const Staff = 'Staff';

    protected $fillable = ['name', 'value'];

    public function Role()
    {
        return $this->hasMany(Role::class);
    }
}
