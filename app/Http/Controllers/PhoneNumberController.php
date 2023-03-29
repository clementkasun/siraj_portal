<?php

namespace App\Http\Controllers;

use App\Repositories\phoneNumber\PhoneNumberRepository;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    private $phoneNumberRepository;

    function __construct(PhoneNumberRepository $phoneNumberRepository)
    {
        $this->phoneNumberRepository = $phoneNumberRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->phoneNumberRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->phoneNumberRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneNumber  $phoneNumber
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->phoneNumberRepository->show();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneNumber  $phoneNumber
     * @return \Illuminate\Http\Response
     */
    public function phoneNumberProfile($id)
    {
        return $this->phoneNumberRepository->phoneNumberProfile($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhoneNumber  $phoneNumber
     * @return \Illuminate\Http\Response
     */
    public function getPhoneNumberDetails($id)
    {
        return $this->phoneNumberRepository->getPhoneNumberDetails($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhoneNumber  $phoneNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->phoneNumberRepository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneNumber  $phoneNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->phoneNumberRepository->destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneNumber  $phoneNumber
     * @return \Illuminate\Http\Response
     */
    public function changePhoneNumberStatus(Request $request, $id)
    {
        return $this->phoneNumberRepository->changePhoneNumberStatus($request, $id);
    }
}
