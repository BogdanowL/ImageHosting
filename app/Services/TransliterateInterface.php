<?php

namespace App\Services;

use Illuminate\Support\Str;

interface TransliterateInterface
{
    public function transliterate(string $string) : string;

    public function transliterateClientName(string $filename, string $extension): string;

    public function toLower(string $filename) : string;

}
