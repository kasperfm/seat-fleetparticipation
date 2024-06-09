<?php

return [
    'fleetparticipation' => [
        'name' => 'Fleet Participation',
        'icon' => 'fa fa-users',
        'route_segment' => 'fleetparticipation',
        'permission' => ['fleetparticipation.view'],
        'entries' => [
            'mypoints' => [
                'name' => 'My fleet points',
                'icon' => 'fa fa-cubes',
                'route' => 'fleetparticipation.mypoints',
                'permission' => ['fleetparticipation.view']
            ],
            'register' => [
                'name' => 'Register fleet',
                'icon' => 'fa fa-users',
                'route' => 'fleetparticipation.register',
                'permission' => ['fleetparticipation.manager']
            ],
            'settings' => [
                'name' => 'Manage points',
                'icon' => 'fa fa-cog',
                'route' => 'fleetparticipation.settings',
                'permission' => ['fleetparticipation.admin']
            ],
        ],
    ]
];