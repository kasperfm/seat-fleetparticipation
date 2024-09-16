@section('title', 'Fleet Statistics')
@section('page_header', 'Fleet Statistics')
@extends('web::layouts.grids.12')

@section('content')
    <p><strong>{{ __('fleetparticipation::plugin.select_month') }}</strong></p>
    <input type="month" id="datepicker_month" name="datepicker_month">

    <table id="highscore-table" class="table" style="margin-top: 30px;">
        <thead>
        <tr>
            <th>Pilot main character</th>
            <th>{{ __('fleetparticipation::plugin.points') }}</th>
        </tr>
        </thead>
        <tbody id="highscore-table-body"></tbody>
    </table>
@endsection

@push('javascript')
    <script type="application/javascript">
        $(document).ready(function () {
            $("#datepicker_month").change(function () {
                var monthValue = $("#datepicker_month").val();

                var honkTable = new DataTable('#highscore-table', {
                    "ajax": {
                        "url": '/fleetparticipation/statistics/highscore',
                        "type": "POST",
                        "dataType": 'json',
                        "cache": false,
                        "data": {
                            _token: "{{ csrf_token() }}",
                            month: monthValue,
                        },
                    },
                    destroy: true,
                    columns: [
                        { data: 'name' },
                        { data: 'honks' },
                    ],
                    searching: true,
                    ordering: false,
                    paging: false,
                });
            });
        });
    </script>
@endpush