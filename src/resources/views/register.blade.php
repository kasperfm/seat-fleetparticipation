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
        @if(empty($fleetId))
            <p>You can also select one of the recent fleets for quicker registration.</p>
            <label for="fleet_id">Recent fleets:</label>
            <select name="fleet_id" id="fleet_id">
                <option selected value="newfleet">New fleet...</option>
                @foreach($latestFleets as $latestFleet)
                    <option value="{{ $latestFleet->id }}" rel="{{ $latestFleet->title ?? 'Unknown fleet'}}">{{ $latestFleet->title ?? 'Unknown fleet'}} (By: {{ $latestFleet->registeredBy->main_character->name }})</option>
                @endforeach
            </select><br>
        @endif
        <label for="title">Name of the fleet or event:</label>
        <input type="text" name="title" id="title" maxlength="100" placeholder="Fleet name..."><br>
        <label for="points">Number of fleet points to give each member:</label>
        <input type="number" name="points" id="points" max="100" min="1" value="1"><br>
        <textarea name="fleet" id="fleet" placeholder="The fleet members..." cols="40" rows="20"></textarea>
        <hr>
        <button type="submit" class="btn btn-info" id="save" name="save">Register</button>
    </form>
@endsection

@push('javascript')
    <script type="application/javascript">
        $(function() {
            $("#fleet_id").change(function () {
                if ($("#fleet_id option:selected").val() === "newfleet") {
                    $("#title").val('');
                } else {
                    $("#title").val($("#fleet_id option:selected").attr('rel'));
                }
            });
        });
    </script>
@endpush