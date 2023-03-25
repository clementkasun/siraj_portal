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
        if (Gate::denies('view-vacancy', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view vacancy!');
        }
        return view('vacancy.registration');
    }

    public function store($request)
    {
        if (Gate::denies('create-vacancy', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to create vacancy!');
        }
        $log = [
            'route' => '/api/save_vacancy',
        ];
        try {

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

            $log['msg'] = 'Saving vacancy is successful!';
            // Notification::send(auth()->user(), new SystemNotification(auth()->user(), $log['msg']));
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving vacancy is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving vacancy was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving vacancy was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-vacancy', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to update vacancy!');
        }
        $log = [
            'route' => '/api/update_vacancy/id/'.$id,
        ];
        try {

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
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating vacancy is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating vacancy is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating vacancy was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating vacancy was unsuccessful!');
        }
    }

    public function getVacancy($id)
    {
        // if (Gate::denies('view-vacancy', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view vacancy!');
        // }
        $log = [
            'route' => '/api/get_vacancy/id/' . $id,
            'msg' => 'Successfully accessed the vacancy record!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Vacancy::find($id);
    }

    public function getPaginatedVacancy($request)
    {
        // if (Gate::denies('view-vacancy', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view vacancy!');
        // }
        $log = [
            'route' => '/api/get_paginated_vacancy',
            'msg' => 'Successfully accessed the vacancy record!',
        ];
        Log::channel('daily')->info(json_encode($log));
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
        return $vacancyArr;
    }

    // public function getFilPagedVacancies($request)
    // {
    //     // if (Gate::denies('view-vacancy', auth()->user())) {
    //     //     return array('status' => 2, 'msg' => 'You are not authorised to view vacancy!');
    //     // }
    //     $log = [
    //         'route' => '/api/get_filtered_vacancy',
    //         'msg' => 'Successfully accessed the filtered vacancy records!',
    //     ];
    //     Log::channel('daily')->info(json_encode($log));
    //     $page = $request->page;
    //     $limit = 6;
    //     $start_from = ($page - 1) * $limit;
    //     $itemCount = Vacancy::all()->count() + 1;
    //     $pages = ceil($itemCount / $limit);
    //     $vacancyArr = array();

    //     // if (isset($country) && isset($keyword) && isset($salary) && isset($job_type)) {
    //     //     $sql = \DB::select("SELECT title, salary, period, location, vacancy_image FROM vacancies where deleted_at IS NULL ORDER BY id ASC LIMIT $start_from, $limit");
    //     // }

    //     // if (isset($country)) {
    //     //     $sql = \DB::select(
    //     //         "SELECT
    //     //             vacancies.title, 
    //     //             vacancies.salary, 
    //     //             vacancies.period, 
    //     //             vacancies.location, 
    //     //             vacancies.vacancy_image
    //     //         FROM
    //     //             vacancies
    //     //         WHERE
    //     //             vacancies.deleted_at IS null AND
    //     //             vacancies.location LIKE '%$country%'
    //     //         GROUP BY
    //     //             vacancies.id
    //     //         ORDER BY
    //     //             vacancies.id ASC
    //     //         LIMIT $start_from, $limit;"
    //     //     );
    //     // }

    //     // if (isset($keyword)) {
    //     //     $sql = \DB::select(
    //     //         "SELECT
    //     //             vacancies.title, 
    //     //             vacancies.salary, 
    //     //             vacancies.period, 
    //     //             vacancies.location, 
    //     //             vacancies.vacancy_image
    //     //         FROM
    //     //             vacancies
    //     //         WHERE
    //     //             vacancies.deleted_at IS null AND
    //     //             vacancies.title LIKE '%$keyword%' OR
    //     //             vacancies.salary LIKE '%$keyword%' OR
    //     //             vacancies.period LIKE '%$keyword%' OR
    //     //             vacancies.location LIKE '%$keyword%' 
    //     //         GROUP BY
    //     //             vacancies.id
    //     //         ORDER BY
    //     //             vacancies.id ASC
    //     //         LIMIT $start_from, $limit;"
    //     //     );
    //     // }

    //     // if (isset($salary)) {
    //     //     $sql = \DB::select(
    //     //         "SELECT
    //     //             vacancies.title, 
    //     //             vacancies.salary, 
    //     //             vacancies.period, 
    //     //             vacancies.location, 
    //     //             vacancies.vacancy_image
    //     //         FROM
    //     //             vacancies
    //     //         WHERE
    //     //             vacancies.salary LIKE '%$salary%' OR
    //     //         GROUP BY
    //     //             vacancies.id
    //     //         ORDER BY
    //     //             vacancies.id ASC
    //     //         LIMIT $start_from, $limit;"
    //     //     );
    //     // }

    //     // if (isset($job_type)) {
    //     //     $sql = \DB::select(
    //     //         "SELECT
    //     //             vacancies.title, 
    //     //             vacancies.salary, 
    //     //             vacancies.period, 
    //     //             vacancies.location, 
    //     //             vacancies.vacancy_image
    //     //         FROM
    //     //             vacancies
    //     //         WHERE
    //     //             vacancies.title LIKE '%$job_type%' OR
    //     //         GROUP BY
    //     //             vacancies.id
    //     //         ORDER BY
    //     //             vacancies.id ASC
    //     //         LIMIT $start_from, $limit;"
    //     //     );
    //     // }

    //     $vacancyArr["body"] = $sql;
    //     $vacancyArr["itemCount"] = $itemCount;
    //     $vacancyArr["pages"] = $pages;
    //     $vacancyArr["current_page"] =  $page;
    //     return $vacancyArr;
    // }

    public function show()
    {
        // if (Gate::denies('view-vacancy', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view vacancy!');
        // }
        $log = [
            'route' => '/api/get_vacancies',
            'msg' => 'Successfully accessed the vacancies!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Vacancy::all();
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-vacancy', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to delete vacancies!');
        }
        $log = [
            'route' => '/api/delete_vacancy/id/' . $id,
            'msg' => 'Successfully deleted the vacancy!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $vacancy =  Vacancy::find($id);
        $vacancy->deleted_by = auth()->user()->id;
        $vacancy->save();

        $status = $vacancy->delete();

        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the vacancy!');
        } else {
            return array('status' => 0, 'msg' => 'Vacancy record deletion was unsuccessful!');
        }
    }
}
