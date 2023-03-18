<?php

namespace App\Http\Controllers;

use App\Repositories\vacancy\VacancyRepository;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    private $vacancyRepository;

    function __construct(VacancyRepository $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->vacancyRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->vacancyRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->vacancyRepository->show();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVacancy($id)
    {
        return $this->vacancyRepository->getVacancy($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginatedVacancy(Request $request){
        return $this->vacancyRepository->getPaginatedVacancy($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFilPagedVacancies(Request $request){
        return $this->vacancyRepository->getFilPagedVacancies($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->vacancyRepository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->vacancyRepository->destroy($id);
    }
}
