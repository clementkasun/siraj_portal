<?php

namespace App\Http\Controllers;

use App\Models\ContactResponse;
use App\Repositories\contactResponse\ContactResponseRepository;
use Illuminate\Http\Request;

class ContactResponseController extends Controller
{
    private $contactResponseRepository;

    function __construct(ContactResponseRepository $contactResponseRepository)
    {
        $this->contactResponseRepository = $contactResponseRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->contactResponseRepository->index($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->contactResponseRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->contactResponseRepository->show();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function getContactResponse($id)
    {
        return $this->contactResponseRepository->getContactResponse($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->contactResponseRepository->destroy($id);
    }


}
