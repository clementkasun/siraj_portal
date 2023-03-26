<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Privillage;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RollController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        $level = Level::get();
        $privillages = Privillage::get();
        $user = Auth::user();
        return view('rolls', ['privillages' => $privillages, 'levels' => $level]);
    }

    public function __construct()
    {
//        $this->middleware(['auth']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'role_name' => ['required', 'string'],
            'level' => ['required', 'numeric'],
        ]);
        $role = new Role();
        $role->name = $request->role_name;
        $role->level_id = $request->level;
        $msg = $role->save();

        if($msg == true){
            return array('status' => 1, 'msg' => 'Role creation is successful!');
        }else{
            return array('status' => 0, 'msg' => 'Role creation was unsuccessful!');
        }
    }
    public function store($id)
    {

        request()->validate([
            'role_id' => ['required', 'string'],
        ]);
        $role = Role::findOrFail($id);
        $role->name = request('role_id');
        $msg = $role->save();

        if ($msg) {
            return array('id' => 1, 'message' => 'true');
        } else {
            return array('id' => 0, 'message' => 'false');
        }
    }

    public function getRolePrivilagesById($id)
    {
        $role = Role::findOrFail($id);
        return $role->RolePrivillage()->get();
    }

    public function getRoles()
    {
         return Role::all();
    }


    public function getRoleById($id)
    {
         return Role::where('id', $id)->get();
    }

    public function PrivillagesAdd()
    {
        \DB::transaction(function () {
            $role = Role::findOrFail(request('role_id'));
            $role->privillages()->detach();
            $status = true;
            foreach (request('privillage') as $value) {

                $role->privileges()->attach(
                    $value['id'],
                    [
                        'is_read' => $value['is_read'],
                        'is_create' => $value['is_create'],
                        'is_update' => $value['is_update'],
                        'is_delete' => $value['is_delete'],
                    ]
                );
            }
        });
        return array('id' => '1', 'msg' => 'true');
    }

    public function destroy($id)
    {
        try {

            $role = Role::findOrFail($id);
            $msg = $role->delete();

            if ($msg) {
//                LogActivity::addToLog('roll deleted', $roll);
                return array('id' => 1, 'message' => 'true');
            } else {
//                LogActivity::addToLog('Fail to delete roll', $roll);
            }
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->errorInfo[0] == 23000) {
                return response(array('id' => 3, 'mgs' => 'Cannot delete foreign key constraint fails'), 200)
                    ->header('Content-Type', 'application/json');
            } else {
                return response(array('id' => 3, 'mgs' => 'Internal Server Error'), 500)
                    ->header('Content-Type', 'application/json');
            }
        }
    }
}
