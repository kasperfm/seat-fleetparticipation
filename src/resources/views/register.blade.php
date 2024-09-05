@section('title', 'Register Fleet Participation')
@section('page_header', 'Register Fleet Participation')
@extends('web::layouts.grids.12')

@section('content')
    <form method="post" action="{{ route('fleetparticipation.register.save') }}">
        @csrf
        @if($fleetId)
            <input type="hidden" value="{{ $fleetId }}" name="fleet_id">
        @endif
        <p>{{ __('fleetparticipation::plugin.register_help_info') }}</p>
        <hr>
        @if(empty($fleetId))
            <p>{{ __('fleetparticipation::plugin.recent_fleets_help_info') }}</p>
            <label for="fleet_id">{{ __('fleetparticipation::plugin.recent_fleets') }}:</label>
            <select name="fleet_id" id="fleet_id">
                <option selected value="newfleet">{{ __('fleetparticipation::plugin.new_fleet') }}...</option>
                @foreach($latestFleets as $latestFleet)
                    <option value="{{ $latestFleet->id }}" rel="{{ $latestFleet->title ?? 'Unknown fleet'}}">{{ $latestFleet->title ?? 'Unknown fleet'}} ({{ __('fleetparticipation::plugin.by_label') }}: {{ $latestFleet->registeredBy->main_character->name }})</option>
                @endforeach
            </select><br>
        @endif
        <label for="title">{{ __('fleetparticipation::plugin.name_of_fleet_label') }}:</label>
        <input type="text" name="title" id="title" maxlength="100" placeholder="{{ __('fleetparticipation::plugin.fleet_name') }}..."><br>
        <label for="points">{{ __('fleetparticipation::plugin.num_of_points_to_give_label') }}:</label>
        <input type="number" name="points" id="points" max="100" min="1" value="1"><br>
        <textarea name="fleet" id="fleet" placeholder="{{ __('fleetparticipation::plugin.members_of_fleet_placeholder') }}..." cols="40" rows="20"></textarea>
        <hr>
        <button type="submit" class="btn btn-info" id="save" name="save">{{ __('fleetparticipation::plugin.register_btn') }}</button>
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