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

        Route::get('/manage', [
            'as' => 'fleetparticipation.manage',
            'uses' => 'FleetParticipationController@manage',
            'middleware' => 'can:fleetparticipation.admin'
        ]);

        Route::get('/edit/{fleet}', [
            'as' => 'fleetparticipation.edit',
            'uses' => 'FleetParticipationController@editFleet',
            'middleware' => 'can:fleetparticipation.admin'
        ]);

        Route::get('/edit/{fleet}/details/{pilot}', [
            'as' => 'fleetparticipation.edit.details',
            'uses' => 'FleetParticipationController@getFleetDetails',
            'middleware' => 'can:fleetparticipation.admin'
        ]);

        Route::post('/edit/{fleet}/details/{pilot}/addpoints', [
            'as' => 'fleetparticipation.edit.details.addpoints',
            'uses' => 'FleetParticipationController@addPointsToMember',
            'middleware' => 'can:fleetparticipation.admin'
        ]);

        Route::post('/edit/{fleet}/details/{pilot}/removepoints', [
            'as' => 'fleetparticipation.edit.details.removepoints',
            'uses' => 'FleetParticipationController@removePointsFromMember',
            'middleware' => 'can:fleetparticipation.admin'
        ]);
    });