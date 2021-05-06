<?php

namespace App\Http;

use App\Models\User;

class Helper
{
    public static function getUser(int $id): string
    {
        if ($id == 0) return "System";

        return User::where('id', $id)->first()->name;
    }
}
