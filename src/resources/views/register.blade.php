@section('title', 'Register Fleet Participation')
@section('page_header', 'Register Fleet Participation')
@extends('web::layouts.grids.12')

@section('content')
    <form method="post" action="{{ route('fleetparticipation.register.save') }}">
        @csrf
        <p>Copy &amp; Paste the fleet members here, and click the button</p>
        <hr>
        <textarea name="fleet" id="fleet" placeholder="The fleet members..." cols="40" rows="20"></textarea>
        <hr>
        <button type="submit" class="btn btn-info" id="save" name="save">Register</button>
    </form>
@endsection
