<?php

namespace App\Repositories\vacancy;

use App\Repositories\vacancy\VacancyInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;

class VacancyRepository implements VacancyInterface
{
    public function index()
    {
        try {
            if (Gate::denies('view-vacancy', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view vacancy!');
            }
            return view('vacancy.registration', ['vacancies' => Vacancy::all()]);
        } catch (Exception $ex) {
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function store($request)
    {
        try {
            if (Gate::denies('create-vacancy', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create vacancy!');
            }
            $request->validate([
                'title' => 'required|string|max:255',
                'salary' => 'required|string|max:255',
                'period' => 'required|string',
                'location' => 'required|string|max:255',
                'vacancy_image' => 'required',
            ]);

            $vacancy = Vacancy::create([
                'title' => $request->title,
                'salary' => $request->salary,
                'period' => $request->period,
                'location' => $request->location,
                'added_by' => auth()->user()->id
            ]);

            if ($request->hasFile('vacancy_image')) {
                $path = public_path('/storage/vacancy/vacancy_img' . $vacancy->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($vacancy->id);

                $vacancy_img_photo     = $request->file('vacancy_image');
                $vacancy_img_photo_ext    = $vacancy_img_photo->extension();

                // I am saying to create the dir if it's not there.
                $vacancy_img_photo = \Image::make($vacancy_img_photo->getRealPath())->resize(500, 500);
                $vacancy_img_photo->save($path . $random_name . '.' . $vacancy_img_photo_ext);
                $vacancy_img_photo_path = '/storage/vacancy/vacancy_img' . $vacancy->id . '/' . $random_name . '.' . $vacancy_img_photo_ext;
                $vacancy->vacancy_image = $vacancy_img_photo_path;
            }

            $vacancy->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Saving vacancy is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Saving vacancy is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Saving vacancy was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Saving vacancy was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-vacancy', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to update vacancy!');
            }
            $request->validate([
                'title' => 'required|string|max:255',
                'salary' => 'required|string|max:255',
                'period' => 'required|string',
                'location' => 'required|string|max:255',
                'vacancy_image' => 'sometimes|nullable',
            ]);

            $vacancy = Vacancy::find($id);
            $vacancy->title = $request->title;
            $vacancy->salary = $request->salary;
            $vacancy->period = $request->period;
            $vacancy->location = $request->location;
            $vacancy->updated_by = auth()->user()->id;

            if ($request->hasFile('vacancy_image')) {
                $path = public_path('/storage/vacancy/vacancy_img' . $vacancy->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($vacancy->id);

                $vacancy_img_photo     = $request->file('vacancy_image');
                $vacancy_img_photo_ext    = $vacancy_img_photo->extension();

                // I am saying to create the dir if it's not there.
                $vacancy_img_photo = \Image::make($vacancy_img_photo->getRealPath())->resize(500, 500);
                $vacancy_img_photo->save($path . $random_name . '.' . $vacancy_img_photo_ext);
                $vacancy_img_photo_path = '/storage/vacancy/vacancy_img' . $vacancy->id . '/' . $random_name . '.' . $vacancy_img_photo_ext;
                $vacancy->vacancy_image = $vacancy_img_photo_path;
            }

            $vacancy->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Updating vacancy is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Updating vacancy is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Updating vacancy was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Updating vacancy was unsuccessful!');
        }
    }

    public function getVacancy($id)
    {
        try {
            $log = [
                'URI' => '/api/get_vacancy/id/' . $id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => Vacancy::find($id)
            ];

            $log['msg'] = 'Accessing vacancy is successful!';
            Log::channel('daily')->info(json_encode($log));
            return Vacancy::find($id);
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing vacancy is unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->info(json_encode($log));
        }
    }

    public function getPaginatedVacancy($request)
    {
        try {
            $page = $request->page;
            $limit = 6;
            $offset = ($page - 1) * $limit;
            $vacancyArr = array();

            $vacancy = Vacancy::where('deleted_at', null);

            $vacancy = $vacancy->when(isset($request->key_word), function ($v) use ($request) {
                return $v->where('vacancies.title', 'like', '%' . $request->key_word . '%')
                    ->orWhere('vacancies.location', 'like', '%' . $request->key_word . '%')
                    ->orWhere('vacancies.salary', 'like', '%' . $request->key_word . '%')
                    ->orWhere('vacancies.period', 'like', '%' . $request->key_word . '%');
            });
            $vacancy = $vacancy->when(isset($request->title), function ($v) use ($request) {
                return $v->where('vacancies.title', 'like', '%' . $request->title . '%');
            });
            // $vacancy = $vacancy->when(isset($request->salary), function ($v) use ($request) {
            //     return $v->where('vacancies.salary', 'like', '%' . $request->salary . '%');
            // });
            $vacancy = $vacancy->when(isset($request->period), function ($v) use ($request) {
                return $v->where('vacancies.period', 'like', '%' . $request->period . '%');
            });
            $vacancy = $vacancy->when(isset($request->location), function ($v) use ($request) {
                return $v->where('vacancies.location', 'like', '%' . $request->location . '%');
            });
            $vacancy = $vacancy->when(isset($request->job_type), function ($v) use ($request) {
                return $v->where('vacancies.title', 'like', '%' . $request->job_type . '%');
            });

            $itemCount = $vacancy->count();
            $pages = ceil($itemCount / $limit);

            $filtered_vacancies = $vacancy->offset($offset)->limit($limit)->get();

            $vacancyArr["body"] = $filtered_vacancies;
            $vacancyArr["itemCount"] = $itemCount;
            $vacancyArr["pages"] = $pages;
            $vacancyArr["current_page"] =  $page;

            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Successfully generated the paginated vacancy!';
            Log::channel('daily')->info(json_encode($log));

            return $vacancyArr;
        } catch (Exception $ex) {
            $log['msg'] = 'Paginated vacancy generating was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function show()
    {
        try {
            $log = [
                'route' => '/api/get_vacancies',
                'msg' => 'Successfully accessed the vacancies!',
            ];
            $log = [
                'URI' => '/api/get_vacancies',
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => Vacancy::all()
            ];
            $log['msg'] = 'Successfully accessed  the vacancy details!';
            Log::channel('daily')->info(json_encode($log));
            return Vacancy::all();
        } catch (Exception $ex) {
            $log['msg'] = 'Vacancy detail access was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function destroy($id)
    {
        try{
            if (Gate::denies('delete-vacancy', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete vacancies!');
            }
            $log = [
                'route' => '/api/delete_vacancy/id/' . $id,
                'msg' => 'Successfully deleted the vacancy!',
            ];
            Log::channel('daily')->info(json_encode($log));
            $vacancy =  Vacancy::find($id);
            $vacancy->deleted_by = auth()->user()->id;
            $vacancy->save();
            $vacancy->delete();

            $logged_user = auth()->user();
            $log = [
                'URI' => '/api/delete_vacancy/id/' . $id,
                'METHOD' => 'DELETE',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];

            $log['msg'] = 'Deleting vacancy is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Successfully deleted the vacancy!');
        }catch(Exception $ex){
            $logged_user = auth()->user();
            $log['msg'] = 'Deleting vacancy was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Vacancy deletion was unsuccessful!');
        }
    }
}
