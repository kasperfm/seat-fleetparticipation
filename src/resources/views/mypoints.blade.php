@section('title', 'View Fleet Participation Points')
@section('page_header', 'Fleet Participation Points')
@extends('web::layouts.grids.6-6')

@section('left')
    <h1>Your total fleet points: {{ $totalPoints ?? 0 }}</h1>
    <h2>Earned this month: {{ $pointsThisMonth }}</h2>
    <hr>
    <p>Fleets you have participated in:</p>
    <ul>
    @foreach($fleets as $fleet)
        <li><strong>{{ $fleet['title'] }}</strong>: {{ $fleet['points'] }} points</li>
    @endforeach
    </ul>
@endsection

@section('right')
    <h1>Corp highscore this month</h1>
    <table class="table" id="highscore_table">
        <thead>
        <tr>
            <th scope="col">Pilot main character</th>
            <th scope="col">Points</th>
        </tr>
        </thead>
        <tbody>
        @foreach($highscore as $pilotName => $entry)
            <tr>
                @if($entry['user_id'] == auth()->user()->id)
                    <td class="table-active"><strong>{{ $pilotName }}</strong></td>
                    <td class="table-active"><strong>{{ $entry['totalPoints'] }}</strong></td>
                @else
                    <td>{{ $pilotName }}</td>
                    <td>{{ $entry['totalPoints'] }}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
