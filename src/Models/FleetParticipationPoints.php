<?php

namespace KasperFM\Seat\FleetParticipation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Seat\Services\Models\ExtensibleModel;
use KasperFM\Seat\FleetParticipation\Models\FleetParticipationFleet;

class FleetParticipationPoints extends ExtensibleModel
{
    public $timestamps = true;

    protected $table = 'kasperfm_fleetparticipation_points';

    protected $fillable = ['id', 'user_id', 'points', 'fleet_id', 'registered_by'];

    public function fleet(): BelongsTo
    {
        return $this->belongsTo(FleetParticipationFleet::class, 'fleet_id', 'id');
    }
}