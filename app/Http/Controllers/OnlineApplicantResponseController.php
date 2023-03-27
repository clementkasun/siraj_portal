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

    public function index($id){
        return $this->onlineApplicantResponseRepository->index($id);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->onlineApplicantResponseRepository->show();
    }
}
