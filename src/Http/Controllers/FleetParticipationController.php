<?php

namespace KasperFM\Seat\FleetParticipation\Http\Controllers;

use KasperFM\Seat\FleetParticipation\Models\FleetParticipationFleet;
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

    public function register(Request $request)
    {
        return view('fleetparticipation::register', ['fleetId' => $request->get('fleet_id')]);
    }

    public function saveFleet(Request $request)
    {
        if (!$request->has('fleet') || empty($request->input('fleet'))) {
            return back()->with('error', 'Unable to register an empty fleet!');
        }

        $pointsValue = $request->input('points');

        if ($request->has('fleet_id')) {
            $fleet = FleetParticipationFleet::find($request->input('fleet_id'));
        } else {
            $fleet = FleetParticipationFleet::create([
                'title' => $request->input('title', 'Unknown fleet'),
                'registered_by' => auth()->user()->id,
            ]);
        }

        foreach (preg_split('/\r\n|\r|\n/', $request->input('fleet')) as $item) {
            $charId = CharacterHelper::getCharacterIdByName($item);

            if (!$charId) {
                continue;
            }

            $main = CharacterHelper::getMainCharacter($charId);

            FleetParticipationPoints::create([
                'user_id' => $main->user_id,
                'points' => $pointsValue,
                'fleet_id' => $fleet->id,
                'registered_by' => auth()->user()->id
            ]);
        }

        return back()->with('status', 'Participants registered successfully :-)');
    }
}