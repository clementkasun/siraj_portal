<?php

namespace App\Http\Controllers;

use App\Repositories\onlineApplicant\OnlineApplicantRepository;
use Illuminate\Http\Request;

class OnlineApplicantController extends Controller
{
    private $onlineApplicantRepository;

    function __construct(OnlineApplicantRepository $onlineApplicantRepository)
    {
        $this->onlineApplicantRepository = $onlineApplicantRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->onlineApplicantRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->onlineApplicantRepository->store($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeOnlineAppStatus(Request $request, $id)
    {
        return $this->onlineApplicantRepository->changeOnlineAppStatus($request, $id);
    }
}
