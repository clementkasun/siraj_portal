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
use function redirect;
use function request;
use function view;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        try {
            if (Gate::denies('view-user', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view users!');
            }
            $users = User::get();
            $level = Level::get();
            return view('user', ['levels' => $level, 'users' => $users]);
        } catch (Exception $ex) {
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function create(Request $request)
    {
        try {
            $logged_user = auth()->user();
            if (Gate::denies('create-user', $logged_user)) {
                return array('status' => 4, 'msg' => 'You are not authorised to create user!');
            }
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
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Saving user is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'User has successfully registered!');
        } catch (Exception $ex) {
            $log['msg'] = 'User saving was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 0, 'msg' => 'User registration failed!');
        }
    }

    public function edit($id)
    {
        try {
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
        } catch (Exception $ex) {
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $logged_user = auth()->user();
            if (Gate::denies('update-user', $logged_user)) {
                return array('status' => 4, 'msg' => 'You are not authorised to update user!');
            }

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

            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Updating user is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 1, 'msg' => 'User has successfully updated!');
        } catch (Exception $ex) {
            $log['msg'] = 'User updating was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 0, 'msg' => 'User updation has failed!');
        }
    }

    public function storePassword(Request $request, $id)
    {
        try {
            $logged_user = auth()->user();
            if (Gate::denies('update-user', $logged_user)) {
                return array('status' => 4, 'msg' => 'You are not authorised to update user!');
            }
            $user = User::findOrFail($id);
            request()->validate([
                'password' => 'required|confirmed|min:4',
            ]);
            $user->password = Hash::make(request('password'));
            $user->save();

            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'User password reset is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return redirect()
                ->back()
                ->with('success', 'password has reset successfully!');
        } catch (Exception $ex) {
            $log['msg'] = 'User updating was unsuccessful!';
            $log['error'] =  $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error');
        }
    }

    public function activeStatus(Request $request, $id)
    {
        try {
            $logged_user = auth()->user();
            if (Gate::denies('update-user', $logged_user)) {
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
            $log['msg'] = 'User status change is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        } catch (Exception $ex) {
            $log['msg'] = 'User status change was unsuccessful!';
            $log['error'] =  $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function privillagesById($id)
    {
        try {
            $user = User::findOrFail($id);
            return $user->Role()->with('RolePrivillage')->get();
        } catch (Exception $ex) {
            $log['msg'] = 'privillage load by id was failed!';
            $log['error'] =  $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function delete($id)
    {
        try {
            $logged_user = auth()->user();
            if (Gate::denies('delete-user', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete user!');
            }
            $user = User::findOrFail($id);
            $user->deleted_by = $logged_user->id;
            $user->save();

            $log['msg'] = 'User deletion is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return ['status' => 1, 'msg' => 'User has deleted successsfully!'];
        } catch (Exception $ex) {
            $log['msg'] = 'User deletion was unsuccesssful!';
            $log['error'] =  $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return ['status' => 0, 'msg' => 'User deletion was unsuccesssful!'];
        }
    }

    public function myProfile()
    {
        try {
            $logged_user = auth()->user();
            $user = User::where('id', Auth::user()->id)->with('Role')->first();
            return view('user_profile', ['user' => $user]);
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing the user profile has failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function userProfile($id)
    {
        try {
            $logged_user = auth()->user();
            $user = User::where('id', $id)->with('Role')->first();
            return view('user_profile', ['user' => $user]);
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing the user profile has failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function is_nic_or_email_exist(Request $request)
    {
        try {
            $logged_user = auth()->user();
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
        } catch (Exception $ex) {
            $log['msg'] = 'validating nic and email has failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function logout_user(Request $request): RedirectResponse
    {
        try{
            $logged_user = auth()->user();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }catch(Exception $ex){
            $log['msg'] = 'logout has failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }
}
