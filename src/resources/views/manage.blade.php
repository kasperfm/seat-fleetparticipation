@section('title', 'Manage Fleet Participation Points')
@section('page_header', 'Manage Participation Points')
@extends('web::layouts.grids.12')

@section('content')
    <table class="table" id="fleet_table">
        <thead>
        <tr>
            <th scope="col">{{ __('fleetparticipation::plugin.registered_at_label') }}</th>
            <th scope="col">{{ __('fleetparticipation::plugin.fleet_name') }}</th>
            <th scope="col">{{ __('fleetparticipation::plugin.registered_by_label') }}</th>
            <th scope="col">{{ __('fleetparticipation::plugin.number_of_members_label') }}</th>
            <th scope="col">{{ __('fleetparticipation::plugin.total_points_label') }}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($fleets as $fleet)
            <tr>
                <th scope="row">{{ $fleet->created_at->toDayDateTimeString() }}</th>
                <td>{{ $fleet->title }}</td>
                <td>{{ $fleet->registeredBy->main_character->name }}</td>
                <td>{{ $fleet->memberCount() }}</td>
                <td>{{ $fleet->points->sum('points') }}</td>
                <td><a href="{{ route('fleetparticipation.edit', $fleet->id) }}">{{ __('fleetparticipation::plugin.edit_btn') }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('javascript')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#fleet_table').DataTable({});
        });
    </script>
@endpush