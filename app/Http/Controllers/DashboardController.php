<?php

namespace App\Http\Controllers;

use App\Repositories\dashboard\DashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    private $dashboardRepository;

    function __construct(DashboardRepository $dashboardRepository)
    {
        $this->middleware('auth');
        $this->dashboardRepository = $dashboardRepository;
    }
    
    public function index() {
        return $this->dashboardRepository->index();
    }
}
