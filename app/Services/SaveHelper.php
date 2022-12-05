<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class SaveHelper implements SaveHelperInterface
{
    private const NUMBER_OF_LETTERS = 25;
    private const SEPARATOR = '_';

    public function getSavePath(string $extension) : string
    {
        $now = Carbon::now();
        return Str::random(self::NUMBER_OF_LETTERS) . self::SEPARATOR .
            $now->year . self::SEPARATOR .
            $now->month . self::SEPARATOR .
            $now->day . $extension;
    }

    public function getOnlyName(string $name) : string
    {
        return pathinfo($name, PATHINFO_FILENAME);
    }


}
