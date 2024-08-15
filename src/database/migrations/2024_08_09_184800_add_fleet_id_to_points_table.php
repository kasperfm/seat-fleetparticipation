<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddFleetIdToPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kasperfm_fleetparticipation_points', function (Blueprint $table) {
            $table->bigInteger('fleet_id')->unsigned()->index()->after('points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kasperfm_fleetparticipation_points', function (Blueprint $table) {
            $table->dropColumn('fleet_id');
        });
    }
}