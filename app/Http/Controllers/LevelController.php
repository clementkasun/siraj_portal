<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Role;

class LevelController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function rolesByLevel($id){
     $roles= Role::where('level_id', $id)->get();
     return $roles;
    }
}
