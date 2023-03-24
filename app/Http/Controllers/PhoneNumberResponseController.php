<?php

namespace App\Http\Controllers;

use App\Repositories\phoneNumberResponse\PhoneNumberResponseRepository;
use Illuminate\Http\Request;

class PhoneNumberResponseController extends Controller
{
    private $phoneNumberResponseRepository;

    function __construct(PhoneNumberResponseRepository $phoneNumberResponseRepository)
    {
        $this->phoneNumberResponseRepository = $phoneNumberResponseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->phoneNumberResponseRepository->index($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->phoneNumberResponseRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneNumberResponse  $phoneNumberResponse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->phoneNumberResponseRepository->show($id);
    }
}
