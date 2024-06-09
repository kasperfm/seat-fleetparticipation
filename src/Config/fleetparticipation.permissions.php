<?php

return [
    'view' => [
        'label'       => 'Users of the fleet participation plugin',
        'description' => 'For everyone who needs access to the plugin',
        'division'    => 'military',
    ],
    'manager' => [
        'label' => 'Fleet Commanders',
        'description' => 'Ability to register fleet participation points',
        'division' => 'military'
    ],
    'admin' => [
        'label' => 'Manage fleet points',
        'description' => 'For super users who want to manage the points for all members',
        'division' => 'military'
    ],
];
