<?php

namespace KasperFM\Seat\FleetParticipation\Models;

use Illuminate\Database\Eloquent\Model;
use Seat\Services\Models\ExtensibleModel;

class FleetParticipationFleet extends ExtensibleModel
{
    public $timestamps = true;

    protected $table = 'kasperfm_fleetparticipation_fleets';

    protected $fillable = ['id', 'title', 'registered_by'];
}