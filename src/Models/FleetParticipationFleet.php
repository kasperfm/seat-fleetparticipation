<?php

namespace KasperFM\Seat\FleetParticipation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Seat\Services\Models\ExtensibleModel;

class FleetParticipationFleet extends ExtensibleModel
{
    public $timestamps = true;

    protected $table = 'kasperfm_fleetparticipation_fleets';

    protected $fillable = ['id', 'title', 'registered_by'];

    public function points(): HasMany
    {
        return $this->hasMany(FleetParticipationPoints::class, 'fleet_id');
    }
}