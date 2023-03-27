<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Role;
use App\Models\Privillage;
use App\Models\RolePrivillage;
use App\Models\User;
use App\Notifications\SystemNotification;
use App\Rules\nationalID;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use function redirect;
use function request;
use function view;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        if (Gate::denies('view-user', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to view users!');
        }
        $users = User::get();
        $level = Level::get();
        return view('user', ['levels' => $level, 'users' => $users]);
    }

    public function create(Request $request)
    {
        $logged_user = auth()->user();
        if (Gate::denies('create-user', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to create user!');
        }
        try {
            \DB::transaction(function () use ($request) {
                request()->validate([
                    'firstName' => 'required|string|max:50',
                    'lastName' => 'required|string|max:50',
                    'fullName' => 'sometimes|nullable|max:255|string',
                    'prefferedName' => 'sometimes|nullable|max:50|string',
                    'address' => 'sometimes|nullable|string|max:255',
                    'mobileNo' => 'sometimes|nullable',
                    'landNo' => 'sometimes|nullable',
                    'birthDate' => 'sometimes|nullable|string',
                    'email' => 'required|string|max:255',
                    'nicFrontImg' => 'sometimes|nullable',
                    'nicBackImg' => 'sometimes|nullable',
                    'userImg' => 'sometimes|nullable',
                    'nic' => ['sometimes', 'nullable', 'unique:users', new nationalID],
                    'role' => 'integer|required',
                    'password' => 'required|min:4',
                ]);

                $user = User::create([
                    'first_name' =>  $request->firstName,
                    'last_name' => $request->lastName,
                    'full_name' => $request->fullName,
                    'preffered_name' => $request->prefferedName,
                    'email' => $request->email,
                    'nic' => $request->nic,
                    'address' => $request->address,
                    'mobile_no' => $request->mobileNo,
                    'land_no' => $request->landNo,
                    'birth_date' => $request->birthDate,
                    'role_id' => $request->role,
                    'password' => Hash::make($request->password),
                    'status' => 'Active'
                ]);

                if ($request->hasFile('nicFrontImg')) {
                    $path = public_path('/storage/user/nic/' . $user->id . '/');
                    \File::exists($path) or \File::makeDirectory($path);
                    $random_name = uniqid($user->id);

                    $nic_front_img_photo     = $request->file('nicFrontImg');
                    $nic_front_img_photo_ext    = $nic_front_img_photo->extension();

                    // I am saying to create the dir if it's not there.
                    $nic_front_img_photo = \Image::make($nic_front_img_photo->getRealPath())->resize(500, 500);
                    $nic_front_img_photo->save($path . $random_name . '.' . $nic_front_img_photo_ext);
                    $nic_front_img_photo_path = '/storage/user/nic/' . $user->id . '/' . $random_name . '.' . $nic_front_img_photo_ext;
                    $user->nic_front_image = $nic_front_img_photo_path;
                }

                if ($request->hasFile('nicBackImg')) {
                    $path = public_path('/storage/user/nic/' . $user->id . '/');
                    \File::exists($path) or \File::makeDirectory($path);
                    $random_name = uniqid($user->id);

                    $nic_back_img_photo     = $request->file('nicBackImg');
                    $nic_back_img_photo_ext    = $nic_back_img_photo->extension();

                    // I am saying to create the dir if it's not there.
                    $nic_back_img_photo = \Image::make($nic_back_img_photo->getRealPath())->resize(500, 500);
                    $nic_back_img_photo->save($path . $random_name . '.' . $nic_back_img_photo_ext);
                    $nic_back_img_photo_path = '/storage/user/nic/' . $user->id . '/' . $random_name . '.' . $nic_back_img_photo_ext;
                    $user->nic_back_image = $nic_back_img_photo_path;
                }
                if ($request->hasFile('userImg')) {
                    $path = public_path('/storage/user/user_image/' . $user->id . '/');
                    \File::exists($path) or \File::makeDirectory($path);
                    $random_name = uniqid($user->id);
                    
                    $user_image_photo     = $request->file('userImg');
                    $user_image_photo_ext    = $user_image_photo->extension();

                    // I am saying to create the dir if it's not there.
                    $user_image_photo = \Image::make($user_image_photo->getRealPath())->resize(500, 500);
                    $user_image_photo->save($path . $random_name . '.' . $user_image_photo_ext);
                    $user_image_photo_path = '/storage/user/user_image/' . $user->id . '/' . $random_name . '.' . $user_image_photo_ext;
                    $user->user_image = $user_image_photo_path;
                }

                $user->save();
            });

            $log = [
                'route' => '/api/save_applicant',
            ];

            $log['msg'] = 'Saving user is successful!';

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'User has successfully registered!');
        } catch (Exception $ex) {
            $log['msg'] = 'User saving was unsuccessful!';
            $log['error'] = $ex;

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            Log::channel('error')->info(json_encode($log));

            return array('status' => 0, 'msg' => 'User registration failed!');
        }
    }

    public function edit($id)
    {
        if (Gate::denies('view-user', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to view user!');
        }
        $user = User::findOrFail($id);
        $level = $user->Role()->with('Level')->first()->Level;
        $levels = Level::all();
        $privillages = Privillage::all();
        $roles = Role::where('level_id', $level->id)->get();
        $activity = array('ACTIVE' => User::ACTIVE, 'INACTIVE' => User::INACTIVE, 'ARCHIVED' => User::ARCHIVED);

        return view('user_update', ['level' => $level, 'levels' => $levels, 'user' => $user, 'privillages' => $privillages, 'roles' => $roles, 'activitys' => $activity]);
    }

    public function privillagesAdd($user)
    {
        $privillages = $user->Role()->with('RolePrivillage')->get();
        foreach ($privillages as $privillage) {
            $privillage->is_create = 1;
            $privillage->is_update = 1;
            $privillage->is_delete = 1;
            $privillage->is_read = 1;
            $privillage->save();
        }
    }

    public function PrivillagesAddById(Request $request, $id)
    {
        $new_privillages = $request->privillage;
        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        if (isset($new_privillages)) {
            foreach ($new_privillages as $new_privilage) {
                $role_privilage = RolePrivillage::where('role_id', $request->role_id)->where('privillage_id', $new_privilage['id']);
                $role_privilage_status = $role_privilage->exists();
                $role_privillage_data = $role_privilage->first();

                if ($role_privilage_status) {
                    if ($role_privillage_data->privillage_id == $new_privilage['id']) {
                        $role_privillage_data->is_create = $new_privilage['is_create'];
                        $role_privillage_data->is_update = $new_privilage['is_update'];
                        $role_privillage_data->is_delete = $new_privilage['is_delete'];
                        $role_privillage_data->is_read = $new_privilage['is_read'];
                        $role_privillage_data->save();
                    }
                } else {
                    RolePrivillage::create([
                        'role_id' => $request->role_id,
                        'privillage_id' => $new_privilage['id'],
                        'is_create' => $new_privilage['is_create'],
                        'is_update' => $new_privilage['is_update'],
                        'is_delete' => $new_privilage['is_delete'],
                        'is_read' => $new_privilage['is_read']
                    ]);
                }
            }
        }

        return array('id' => '1', 'msg' => 'Successfully changed the privillages');
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('update-user', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to update user!');
        }
        try {

            $user = User::findOrFail($id);
            $user->update([
                'first_name' =>  $request->firstName,
                'last_name' => $request->lastName,
                'full_name' => $request->fullName,
                'preffered_name' => $request->prefferedName,
                'address' => $request->address,
                'mobile_no' => $request->mobileNo,
                'land_no' => $request->landNo,
                'birth_date' => $request->birthDate,
                'role_id' => $request->role,
            ]);

            if ($request->hasFile('nicFrontImg')) {
                $path = public_path('/storage/user/nic/' . $user->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($user->id);

                $nic_front_img_photo     = $request->file('nicFrontImg');
                $nic_front_img_photo_ext    = $nic_front_img_photo->extension();

                // I am saying to create the dir if it's not there.
                $nic_front_img_photo = \Image::make($nic_front_img_photo->getRealPath())->resize(500, 500);
                $nic_front_img_photo->save($path . $random_name . '.' . $nic_front_img_photo_ext);
                $nic_front_img_photo_path = '/storage/user/nic/' . $user->id . '/' . $random_name . '.' . $nic_front_img_photo_ext;
                $user->nic_front_image = $nic_front_img_photo_path;
            }

            if ($request->hasFile('nicBackImg')) {
                $path = public_path('/storage/user/nic/' . $user->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($user->id);

                $nic_back_img_photo     = $request->file('nicBackImg');
                $nic_back_img_photo_ext    = $nic_back_img_photo->extension();

                // I am saying to create the dir if it's not there.
                $nic_back_img_photo = \Image::make($nic_back_img_photo->getRealPath())->resize(500, 500);
                $nic_back_img_photo->save($path . $random_name . '.' . $nic_back_img_photo_ext);
                $nic_back_img_photo_path = '/storage/user/nic/' . $user->id . '/' . $random_name . '.' . $nic_back_img_photo_ext;
                $user->nic_back_image = $nic_back_img_photo_path;
            }

            if ($request->hasFile('userImg')) {
                $path = public_path('/storage/user/user_image/' . $user->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($user->id);

                $user_image_photo     = $request->file('userImg');
                $user_image_photo_ext    = $user_image_photo->extension();

                // I am saying to create the dir if it's not there.
                $user_image_photo = \Image::make($user_image_photo->getRealPath())->resize(500, 500);
                $user_image_photo->save($path . $random_name . '.' . $user_image_photo_ext);
                $user_image_photo_path = '/storage/user/user_image/' . $user->id . '/' . $random_name . '.' . $user_image_photo_ext;
                $user->user_image = $user_image_photo_path;
            }
            $user->save();
            return array('status' => 1, 'msg' => 'User has successfully updated!');
        } catch (Exception $ex) {
            return array('status' => 0, 'msg' => 'User updation has failed!');
        }
    }

    public function storePassword(Request $request, $id)
    {
        if (Gate::denies('update-user', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to update user!');
        }
        $user = User::findOrFail($id);
        request()->validate([
            'password' => 'required|confirmed|min:4',
        ]);
        $user->password = Hash::make(request('password'));
        $msg = $user->save();

        if ($msg) {
            return redirect()
                ->back()
                ->with('success', 'Ok');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error');
        }
    }

    public function activeStatus(Request $request, $id)
    {
        if (Gate::denies('update-user', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to update user!');
        }
        $user = User::findOrFail($id);

        switch ($request['status']) {
            case 'ACTIVE':
                $user->status = User::ACTIVE;
                $user->save();
                return array('id' => 1, 'msg' => 'success');
                break;
            case 'INACTIVE':
                $user->status = User::INACTIVE;
                $user->save();
                return array('id' => 1, 'msg' => 'success');
                break;
            case 'ARCHIVED':
                $user->status = User::ARCHIVED;
                $user->save();
                return array('id' => 1, 'msg' => 'success');
                break;
            default:
                return array('id' => 2, 'msg' => 'invalid Input');
        }
        $user->save();
    }

    public function privillagesById($id)
    {
        $user = User::findOrFail($id);
        return $user->Role()->with('RolePrivillage')->get();
    }

    public function delete($id)
    {
        // if (Gate::denies('delete-user', auth()->user())) {
        //     return array('status' => 4, 'msg' => 'You are not authorised to delete user!');
        // }
        $delete_user = User::findOrFail($id)->delete();
        if ($delete_user) {
            return ['status' => 1, 'msg' => 'User has deleted successsfully!'];
        } else {
            return ['status' => 0, 'msg' => 'User deletion was unsuccesssful!'];
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    public function myProfile()
    {
        $user = User::where('id', Auth::user()->id)->with('Role')->first();
        return view('user_profile', ['user' => $user]);
    }

    public function changeMyPass()
    {
        if (Gate::denies('update-user', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to update user!');
        }
        $aUser = User::find(Auth::user()->id);
        request()->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        $aUser->password = Hash::make(request('password'));
        $msg = $aUser->save();

        if ($msg) {
            return redirect()
                ->back()
                ->with('success', 'Ok');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error');
        }
    }

    public function getDeletedUser()
    {
        return User::onlyTrashed()->get();
    }

    public function activeDeletedUser($id)
    {
        $msg = User::withTrashed()->find($id)->restore();

        if ($msg) {
            return array('id' => 1, 'mgs' => 'true');
        } else {
            return array('id' => 0, 'mgs' => 'false');
        }
    }

    public function authToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->whereHas('role.level', function ($query) {
            $query->where('levels.value', '3');
        })->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return array("token" => $user->createToken($request->device_name)->plainTextToken, 'user' => $user);
    }

    public function is_nic_or_email_exist(Request $request)
    {
        $email_status = User::where('email', $request->email)->exists();
        $nic_status = User::where('nic', $request->nic)->exists();

        if ($email_status == true && $nic_status == false) {
            return ['status' => 1];
        }
        if ($nic_status == true && $email_status == false) {
            return ['status' => 2];
        }
        if ($email_status == true && $nic_status == true) {
            return ['status' => 3];
        }
        if ($email_status == false && $nic_status == false) {
            return ['status' => 0];
        }
    }

    public function logout_user(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
