@section('title', 'Edit Fleet')
@section('page_header', 'Edit Fleet')
@extends('web::layouts.grids.12')

@section('content')
    <h1>Fleet: {{ $fleet->title }}</h1>

    <table class="table" id="edit_fleet_table">
        <thead>
        <tr>
            <th scope="col">Pilot name</th>
            <th scope="col">Points</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach($pilots as $pilotName => $entry)
                <tr>
                    <td>{{ $pilotName }}</td>
                    <td>{{ $entry['totalPoints'] }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showPilotDetails" data-character="{{ $pilotName }}" data-userid="{{ $entry['user_id'] }}">Details</button>
                        <button type="button" class="btn btn-success add-points-to-member-btn" data-userid="{{ $entry['user_id'] }}">Add point</button>
                        <button type="button" class="btn btn-danger remove-points-from-member-btn" data-userid="{{ $entry['user_id'] }}">Remove point</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="showPilotDetails" tabindex="-1" role="dialog" aria-labelledby="showPilotDetailsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showPilotDetailsLabel">Pilot details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="details_table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Points</th>
                                <th>Registered by</th>
                            </tr>
                        </thead>
                        <tbody id="details-table-body">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#edit_fleet_table').DataTable({});
            var pointsTable;

            $(".add-points-to-member-btn").click(function (event) {
                var userId = event.target.dataset.userid

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        points: 1,
                    },
                    url: '/fleetparticipation/edit/{{$fleet->id}}/details/' + userId + '/addpoints',
                    success: function(response) {
                        alert(1 + ' point added to the fleet member.');
                    }
                });
            });

            $(".remove-points-from-member-btn").click(function (event) {
                var userId = event.target.dataset.userid

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        points: 1,
                    },
                    url: '/fleetparticipation/edit/{{$fleet->id}}/details/' + userId + '/removepoints',
                    success: function(response) {
                        alert(1 + ' point removed from the fleet member.');
                    }
                });
            });

            $('#showPilotDetails').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var user = button.data('userid') // Extract info from data-* attributes
                var pilotName = button.data('character') // Extract info from data-* attributes

                getMemberPointsUsingAjax(user);
                pointsTable = $('#details_table').DataTable({
                    searching: false,
                    ordering: false,
                    paging: false,
                    retrieve: true
                });

                var modal = $(this)
                modal.find('.modal-title').text(pilotName)
            });

            function getMemberPointsUsingAjax(user)
            {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '/fleetparticipation/edit/{{$fleet->id}}/details/' + user,
                    success: function(response) {
                        var table = document.getElementById('details-table-body');
                        table.innerHTML = '';
                        append_json_to_table(response);
                        $('#details_table').DataTable({
                            searching: false,
                            ordering: false,
                            paging: false,
                            retrieve: true
                        });
                    }
                });
            }

            function append_json_to_table(data)
            {
                var table = document.getElementById('details-table-body');
                data.forEach(function(object) {
                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td>' + object.timestamp + '</td>' +
                        '<td>' + object.points + '</td>' +
                        '<td>' + object.registered_by + '</td>';
                    table.appendChild(tr);
                });
            }
        });
    </script>
@endpush