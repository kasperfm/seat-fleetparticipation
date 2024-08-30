@section('title', 'Manage Fleet Participation Points')
@section('page_header', 'Manage Participation Points')
@extends('web::layouts.grids.12')

@section('content')
    <table class="table" id="fleet_table">
        <thead>
        <tr>
            <th scope="col">Registered at</th>
            <th scope="col">Fleet title</th>
            <th scope="col">Registered by</th>
            <th scope="col">Number of members</th>
            <th scope="col">Total points</th>
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
                <td><a href="{{ route('fleetparticipation.edit', $fleet->id) }}">Edit</a></td>
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