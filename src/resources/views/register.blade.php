@section('title', 'Register Fleet Participation')
@section('page_header', 'Register Fleet Participation')
@extends('web::layouts.grids.12')

@section('content')
    <form method="post" action="{{ route('fleetparticipation.register.save') }}">
        @csrf
        @if($fleetId)
            <input type="hidden" value="{{ $fleetId }}" name="fleet_id">
        @endif
        <p>Copy &amp; Paste the fleet members here, write a event title, and click the Register button</p>
        <hr>
        <label for="title">Name of the fleet or event:</label>
        <input type="text" name="title" id="title" maxlength="100" placeholder="Fleet name..."><br>
        <label for="points">Number of fleet points to give each member:</label>
        <input type="number" name="points" id="points" max="100" min="1" value="1"><br>
        <textarea name="fleet" id="fleet" placeholder="The fleet members..." cols="40" rows="20"></textarea>
        <hr>
        <button type="submit" class="btn btn-info" id="save" name="save">Register</button>
    </form>
@endsection
