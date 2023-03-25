<?php

namespace App\Http\Controllers;

use App\Repositories\onlineApplicantResponse\OnlineApplicantResponseRepository;
use Illuminate\Http\Request;

class OnlineApplicantResponseController extends Controller
{
    private $onlineApplicantResponseRepository;

    function __construct(OnlineApplicantResponseRepository $onlineApplicantResponseRepository)
    {
        $this->onlineApplicantResponseRepository = $onlineApplicantResponseRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->onlineApplicantResponseRepository->store($request);
    }
}
