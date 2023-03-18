<?php

namespace App\Http\Controllers;

use App\Repositories\previousEmployeemnt\PreviousEmployeementRepository;
use Illuminate\Http\Request;

class ApplicantPreviousEmployeementController extends Controller
{
    private $previousEmployeement;

    function __construct(PreviousEmployeementRepository $previousEmployeement)
    {
        $this->previousEmployeement = $previousEmployeement;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->previousEmployeement->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->previousEmployeement->show($id);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPreviousEmployeement($id)
    {
        return $this->previousEmployeement->getPreviousEmployeement($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->previousEmployeement->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->previousEmployeement->destroy($id);
    }
}
