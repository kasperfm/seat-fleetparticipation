<?php

namespace KasperFM\Seat\FleetParticipation\Models;

use Illuminate\Database\Eloquent\Model;

class FleetParticipationPoints extends Model
{
    public $timestamps = true;

    protected $table = 'kasperfm_fleetparticipation_points';

    protected $fillable = ['id', 'user_id', 'points', 'registered_by'];
}