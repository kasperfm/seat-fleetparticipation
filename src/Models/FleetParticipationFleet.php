<?php

namespace KasperFM\Seat\FleetParticipation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Seat\Services\Models\ExtensibleModel;
use Seat\Web\Models\User;

class FleetParticipationFleet extends ExtensibleModel
{
    public $timestamps = true;

    protected $table = 'kasperfm_fleetparticipation_fleets';

    protected $fillable = ['id', 'title', 'registered_by'];

    public function points(): HasMany
    {
        return $this->hasMany(FleetParticipationPoints::class, 'fleet_id');
    }

    public function registeredBy(): HasOne
    {
        return $this->hasOne(User::Class, 'id', 'registered_by');
    }
}