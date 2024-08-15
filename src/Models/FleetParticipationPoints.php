<?php

namespace KasperFM\Seat\FleetParticipation\Models;

use Illuminate\Database\Eloquent\Model;
use Seat\Services\Models\ExtensibleModel;

class FleetParticipationPoints extends ExtensibleModel
{
    public $timestamps = true;

    protected $table = 'kasperfm_fleetparticipation_points';

    protected $fillable = ['id', 'user_id', 'points', 'fleet_id', 'registered_by'];
}