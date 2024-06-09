<?php

namespace KasperFM\Seat\FleetParticipation\Helpers;

use Illuminate\Support\Facades\DB;

class CharacterHelper
{
    public static function getMainCharacter (int $character_id) : object {
        return DB::table('refresh_tokens as rt')
            ->join('users as u', 'rt.user_id', '=', 'u.id')
            ->where('rt.character_id', '=', $character_id)
            ->first();
    }

    public static function getCharacterName(int $character_id) {
        $data = DB::table('character_infos')
            ->select('name')
            ->where('character_id', '=', $character_id)
            ->first();
        if (!is_null($data))
            return $data->name;
        else
            return "unknown";
    }

    public static function getCharacterIdByName(string $name) {
        $data = DB::table('character_infos')
            ->select('character_id', 'name')
            ->where('name', '=', $name)
            ->first();
        return $data?->character_id;
    }
}