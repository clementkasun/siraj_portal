<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Role;
use App\Models\Privillage;
use App\Models\User;
use App\Rules\contactNo;
use App\Rules\nationalID;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use function redirect;
use function request;
use function view;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Framework\Constraint\IsType;

class UserController extends Controller
{

    public function index()
    {
        if (Gate::denies('view-user', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view users!');
        }
        $users = User::get();
        $level = Level::get();
        return view('user', ['levels' => $level, 'users' => $users]);
    }

    public function create(Request $request)
    {
        try {
            \DB::transaction(function () use ($request) {
                request()->validate([
                    'firstName' => 'required|max:50|string',
                    'lastName' => 'required|nullable|max:50|string',
                    'fullName' => 'sometimes|nullable|max:255|string',
                    'prefferedName' => 'sometimes|nullable|max:50|string',
                    'address' => 'sometimes|nullable|string|max:255',
                    'mobileNo' => ['nullable', new contactNo],
                    'landNo' => ['nullable', new contactNo],
                    'birthDate' => 'sometimes|nullable|string',
                    'email' => 'required|string|max:255',
                    'nicFrontImg' => 'sometimes|nullable',
                    'nicBackImg' => 'sometimes|nullable',
                    'userImg' => 'sometimes|nullable',
                    'nic' => ['sometimes', 'nullable', 'unique:users', new nationalID],
                    'role' => 'integer|required',
                    'password' => 'required|min:6',
                ]);

                $user = User::create([
                    'firstName' =>  $request->firstName,
                    'lastName' => $request->lastName,
                    'fullName' => $request->fullName,
                    'email' => $request->email,
                    'nic' => $request->nic,
                    'prefferedName' => $request->prefferedName,
                    'address' => $request->address,
                    'mobileNo' => $request->mobileNo,
                    'landNo' => $request->landNo,
                    'birthDate' => $request->birthDate,
                    'role_id' => $request->role,
                    'password' => Hash::make($request->password)
                ]);

                if ($request->hasFile('nicFrontImg')) {
                    $path = public_path('/storage/user/nic/nic_front_img' . $user->id . '/');
                    \File::exists($path) or \File::makeDirectory($path);
                    $random_name = uniqid($user->id);

                    $nic_front_img_photo     = $request->file('nicFrontImg');
                    $nic_front_img_photo_ext    = $nic_front_img_photo->extension();

                    // I am saying to create the dir if it's not there.
                    $nic_front_img_photo = \Image::make($nic_front_img_photo->getRealPath())->resize(500, 500);
                    $nic_front_img_photo->save($path . $random_name . '.' . $nic_front_img_photo_ext);
                    $nic_front_img_photo_path = '/storage/user/nic/nic_front_img' . $user->id . '/' . $random_name . '.' . $nic_front_img_photo_ext;
                    $user->nic_front_image = $nic_front_img_photo_path;
                }

                if ($request->hasFile('nicBackImg')) {
                    $path = public_path('/storage/user/nic/nic_back_img' . $user->id . '/');
                    \File::exists($path) or \File::makeDirectory($path);
                    $random_name = uniqid($user->id);

                    $nic_back_img_photo     = $request->file('nicBackImg');
                    $nic_back_img_photo_ext    = $nic_back_img_photo->extension();

                    // I am saying to create the dir if it's not there.
                    $nic_back_img_photo = \Image::make($nic_back_img_photo->getRealPath())->resize(500, 500);
                    $nic_back_img_photo->save($path . $random_name . '.' . $nic_back_img_photo_ext);
                    $nic_back_img_photo_path = '/storage/user/nic/nic_back_img' . $user->id . '/' . $random_name . '.' . $nic_back_img_photo_ext;
                    $user->nic_back_image = $nic_back_img_photo_path;
                }

                if ($request->hasFile('userImg')) {
                    $path = public_path('/storage/user/user_image' . $user->id . '/');
                    \File::exists($path) or \File::makeDirectory($path);
                    $random_name = uniqid($user->id);

                    $user_image_photo     = $request->file('userImg');
                    $user_image_photo_ext    = $user_image_photo->extension();

                    // I am saying to create the dir if it's not there.
                    $user_image_photo = \Image::make($user_image_photo->getRealPath())->resize(500, 500);
                    $user_image_photo->save($path . $random_name . '.' . $nic_front_img_photo_ext);
                    $user_image_photo_path = '/storage/user/user_image' . $user->id . '/' . $random_name . '.' . $user_image_photo_ext;
                    $user->user_image = $user_image_photo_path;
                }

                $user->save();
            });
            return array('status' => 1, 'msg' => 'User has successfully registered!');
        } catch (Exception $ex) {
            return array('status' => 0, 'msg' => 'User registration failed!');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $level = $user->Role()->with('Level')->first();
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
        $privillages = $request->privillages;
        $user = User::findOrFail($id);
        $user->save();

        $privillages = $user->Role()->with('RolePrivillage')->get();
        foreach ($privillages[0]->RolePrivillage as $privillage) {
            if (isset($request->privillage)) {
                foreach ($request->privillage as $new_privillage) {
                    if ($new_privillage['id'] == $privillage->id) {
                        $privillage->is_create = $new_privillage['is_create'];
                        $privillage->is_update = $new_privillage['is_update'];
                        $privillage->is_delete = $new_privillage['is_delete'];
                        $privillage->is_read = $new_privillage['is_read'];
                    }
                }
                $privillage->save();
            }
        }
        return array('id' => '1', 'msg' => 'ok');
    }

    public function update(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            $user->update([
                'firstName' =>  $request->firstName,
                'lastName' => $request->lastName,
                'fullName' => $request->fullName,
                'prefferedName' => $request->prefferedName,
                'address' => $request->address,
                'mobileNo' => $request->mobileNo,
                'landNo' => $request->landNo,
                'birthDate' => $request->birthDate,
            ]);

            if ($request->hasFile('nicFrontImg')) {
                $path = public_path('/storage/user/nic/nic_front_img' . $user->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($user->id);

                $nic_front_img_photo     = $request->file('nicFrontImg');
                $nic_front_img_photo_ext    = $nic_front_img_photo->extension();

                // I am saying to create the dir if it's not there.
                $nic_front_img_photo = \Image::make($nic_front_img_photo->getRealPath())->resize(500, 500);
                $nic_front_img_photo->save($path . $random_name . '.' . $nic_front_img_photo_ext);
                $nic_front_img_photo_path = '/storage/user/nic/nic_front_img' . $user->id . '/' . $random_name . '.' . $nic_front_img_photo_ext;
                $user->nic_front_image = $nic_front_img_photo_path;
            }

            if ($request->hasFile('nicBackImg')) {
                $path = public_path('/storage/user/nic/nic_back_img' . $user->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($user->id);

                $nic_back_img_photo     = $request->file('nicBackImg');
                $nic_back_img_photo_ext    = $nic_back_img_photo->extension();

                // I am saying to create the dir if it's not there.
                $nic_back_img_photo = \Image::make($nic_back_img_photo->getRealPath())->resize(500, 500);
                $nic_back_img_photo->save($path . $random_name . '.' . $nic_back_img_photo_ext);
                $nic_back_img_photo_path = '/storage/user/nic/nic_back_img' . $user->id . '/' . $random_name . '.' . $nic_back_img_photo_ext;
                $user->nic_back_image = $nic_back_img_photo_path;
            }

            if ($request->hasFile('userImg')) {
                $path = public_path('/storage/user/user_image' . $user->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($user->id);

                $user_image_photo     = $request->file('userImg');
                $user_image_photo_ext    = $user_image_photo->extension();

                // I am saying to create the dir if it's not there.
                $user_image_photo = \Image::make($user_image_photo->getRealPath())->resize(500, 500);
                $user_image_photo->save($path . $random_name . '.' . $nic_front_img_photo_ext);
                $user_image_photo_path = '/storage/user/user_image' . $user->id . '/' . $random_name . '.' . $user_image_photo_ext;
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
        $user = User::findOrFail($id);
        request()->validate([
            'password' => 'required|confirmed|min:6',
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
        $user = User::findOrFail($id);
        switch ($request['status']) {
            case 'ACTIVE':
                $user->activeStatus = User::ACTIVE;
                return array('id' => 1, 'msg' => 'success');
                break;
            case 'INACTIVE':
                $user->activeStatus = User::INACTIVE;
                return array('id' => 1, 'msg' => 'success');
                break;
            case 'ARCHIVED':
                $user->activeStatus = User::ARCHIVED;
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
        $user = User::findOrFail($id)->delete();
        $users = User::with('role')->get();
        $level = Level::get();
        return view('user', ['levels' => $level, 'users' => $users]);
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    public function myProfile()
    {
        $user = Auth::user();
        return view('my_profile', ['user' => $user]);
    }

    public function changeMyPass()
    {
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
}
