<?php

namespace KasperFM\Seat\FleetParticipation\Http\Controllers;

use KasperFM\Seat\FleetParticipation\Models\FleetParticipationPoints;
use KasperFM\Seat\FleetParticipation\Helpers\CharacterHelper;
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

    public function saveFleet(Request $request)
    {
        if (!$request->has('fleet')) {
            return;
        }

        foreach (preg_split('/\r\n|\r|\n/', $request->input('fleet')) as $item) {
            $charId = CharacterHelper::getCharacterIdByName($item);

            if (!$charId) {
                continue;
            }

            $main = CharacterHelper::getMainCharacter($charId);

            FleetParticipationPoints::create([
                'user_id' => $main->user_id,
                'points' => 1,
                'registered_by' => auth()->user()->id
            ]);
        }

        return back();
    }
}