<?php

namespace App\Http\Controllers;

use App\Repositories\candidateResponse\CandidateResponseRepository;
use Illuminate\Http\Request;

class CandidateResponseController extends Controller
{
    private $candidateResponseRepository;

    function __construct(CandidateResponseRepository $candidateResponseRepository)
    {
        $this->candidateResponseRepository = $candidateResponseRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->candidateResponseRepository->index($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->candidateResponseRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CandidateResponse  $candidateResponse
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->candidateResponseRepository->show();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCandidate($id)
    {
        return $this->candidateResponseRepository->getCandidate($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->candidateResponseRepository->update($request, $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->candidateResponseRepository->destroy($id);
    }
}
