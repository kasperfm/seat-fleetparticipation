<?php

return [
    'fleetparticipation' => [
        'name' => 'Fleet Participation',
        'icon' => 'fa fa-users',
        'route_segment' => 'fleetparticipation',
        'label' => 'fleetparticipation::menu.main_level',
        'permission' => ['fleetparticipation.view'],
        'entries' => [
            'mypoints' => [
                'name' => 'My fleet points',
                'label' => 'fleetparticipation::menu.my_points',
                'icon' => 'fa fa-cubes',
                'route' => 'fleetparticipation.mypoints',
                'permission' => ['fleetparticipation.view']
            ],
            'register' => [
                'name' => 'Register fleet',
                'label' => 'fleetparticipation::menu.register_fleet',
                'icon' => 'fa fa-users',
                'route' => 'fleetparticipation.register',
                'permission' => ['fleetparticipation.manager']
            ],
            'settings' => [
                'name' => 'Manage points',
                'label' => 'fleetparticipation::menu.manage_fleets',
                'icon' => 'fa fa-cog',
                'route' => 'fleetparticipation.manage',
                'permission' => ['fleetparticipation.admin']
            ],
            'statistics' => [
                'name' => 'Statistics',
                'label' => 'fleetparticipation::menu.statistics',
                'icon' => 'fa fa-chart-bar',
                'route' => 'fleetparticipation.statistics',
                'permission' => ['fleetparticipation.admin']
            ],
        ],
    ]
];