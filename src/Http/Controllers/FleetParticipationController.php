<?php

namespace KasperFM\Seat\FleetParticipation\Http\Controllers;

use Seat\Web\Models\User;
use KasperFM\Seat\FleetParticipation\Models\FleetParticipationFleet;
use KasperFM\Seat\FleetParticipation\Models\FleetParticipationPoints;
use KasperFM\Seat\FleetParticipation\Helpers\CharacterHelper;
use Seat\Web\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class ExportController
 *
 * @package KasperFM\Seat\FleetParticipation
 */
class FleetParticipationController extends Controller
{
    public function mypoints()
    {
        $points = FleetParticipationPoints::with('fleet')->where('user_id', auth()->user()->id)->get();
        $totalPoints = FleetParticipationPoints::where('user_id', auth()->user()->id)->sum('points');

        $fleetPoints = $points->groupBy([function ($item) {
            return $item->fleet?->title ?? 'Unknown fleet';
        }]);

        $fleets = [];
        foreach ($fleetPoints as $title => $fleet) {
            $fleetEntry = [];
            $fleetEntry['points'] = $fleet->sum('points');
            $fleetEntry['title'] = $title;

            $fleets[] = $fleetEntry;
        }

        $pointsThisMonth = FleetParticipationPoints::where('user_id', auth()->user()->id)->whereMonth('created_at', Carbon::now()->month)->sum('points');

        return view('fleetparticipation::mypoints', [
            'fleets' => $fleets,
            'totalPoints' => $totalPoints,
            'pointsThisMonth' => $pointsThisMonth
        ]);
    }

    public function register(Request $request)
    {
        $latestFleets = FleetParticipationFleet::latest()->take(5)->get();

        return view('fleetparticipation::register', [
            'fleetId' => $request->get('fleet_id'),
            'latestFleets' => $latestFleets
        ]);
    }

    public function manage(Request $request)
    {
        $fleets = FleetParticipationFleet::all();

        return view('fleetparticipation::manage', [
            'fleets' => $fleets
        ]);
    }

    public function addPointsToMember(Request $request, FleetParticipationFleet $fleet, User $pilot)
    {
        if (!$request->has('points') || empty($request->input('points'))) {
            return response()->json(['success' => false]);
        }

        FleetParticipationPoints::create([
            'user_id' => $pilot->id,
            'points' => $request->input('points'),
            'fleet_id' => $fleet->id,
            'registered_by' => auth()->user()->id
        ]);

        return response()->json(['success' => true]);
    }

    public function getFleetDetails(Request $request, FleetParticipationFleet $fleet, User $pilot)
    {
        $details = $fleet->points()->where('user_id', $pilot->id)->get();

        $result = [];
        foreach ($details as $detail) {
            $entry = [];
            $entry['timestamp'] = $detail->created_at->toDayDateTimeString();
            $entry['points'] = $detail->points;
            $entry['registered_by'] = User::find($detail->registered_by)->main_character->name;

            $result[] = $entry;
        }

        return response()->json($result);
    }

    public function editFleet(Request $request, FleetParticipationFleet $fleet)
    {
        $fleetMembers = FleetParticipationPoints::where('fleet_id', $fleet->id)->orderBy('user_id')
            ->get()
            ->groupBy('user_id');

        $pilots = [];
        foreach ($fleetMembers as $pilotID => $fleetMemberPoints) {
            $pilot = [];
            $pilotName = User::find($pilotID)->main_character->name;

            $pilot['totalPoints'] = FleetParticipationPoints::where('fleet_id', $fleet->id)->where('user_id', $pilotID)->sum('points');
            $pilot['entries'] = $fleetMemberPoints;
            $pilot['user_id'] = $pilotID;
            $pilots[$pilotName] = $pilot;
        }

        return view('fleetparticipation::editfleet', [
            'fleet' => $fleet,
            'pilots' => $pilots
        ]);
    }

    public function saveFleet(Request $request)
    {
        if (!$request->has('fleet') || empty($request->input('fleet'))) {
            return back()->with('error', 'Unable to register an empty fleet!');
        }

        $pointsValue = $request->input('points');

        if ($request->has('fleet_id') && $request->input('fleet_id') !== "newfleet") {
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

        return back()->with('status', 'Fleet participants registered successfully :-)');
    }
}