<?php

namespace KasperFM\Seat\FleetParticipation\Http\Controllers;

use KasperFM\Seat\FleetParticipation\Models\FleetParticipationPoints;
use Seat\Web\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class ExportController
 *
 * @package KasperFM\Seat\FleetParticipation
 */
class FleetParticipationController extends Controller
{
    public function mypoints()
    {
        return view('fleetparticipation::mypoints');
    }

    public function register()
    {
        return view('fleetparticipation::register');
    }
}