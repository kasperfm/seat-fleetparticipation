<?php
    Route::group([
        'namespace' => 'KasperFM\Seat\FleetParticipation\Http\Controllers',
        'prefix' => 'fleetparticipation',
        'middleware' => ['web', 'auth', 'can:fleetparticipation.view']
    ], function () {
        Route::get('/mypoints', [
            'as' => 'fleetparticipation.mypoints',
            'uses' => 'FleetParticipationController@mypoints'
        ]);

        Route::get('/register', [
            'as' => 'fleetparticipation.register',
            'uses' => 'FleetParticipationController@register',
            'middleware' => 'can:fleetparticipation.manager'
        ]);
        Route::post('/register', [
            'as' => 'fleetparticipation.register.save',
            'uses' => 'FleetParticipationController@saveFleet',
            'middleware' => 'can:fleetparticipation.manager'
        ]);

        Route::get('/admin', [
            'as' => 'fleetparticipation.settings',
            'uses' => 'FleetParticipationController@register',
            'middleware' => 'can:fleetparticipation.admin'
        ]);
    });