@section('title', 'View Fleet Participation Points')
@section('page_header', 'Fleet Participation Points')
@extends('web::layouts.grids.12')

@section('content')
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
