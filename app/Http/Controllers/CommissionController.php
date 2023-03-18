<?php

namespace App\Http\Controllers;

use App\Repositories\comission\ComissionRepository;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    private $comissionRepository;

    function __construct(ComissionRepository $comissionRepository)
    {
        $this->comissionRepository = $comissionRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->comissionRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->comissionRepository->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getComission($id)
    {
        return $this->comissionRepository->getComission($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->comissionRepository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->comissionRepository->destroy($id);
    }
}
