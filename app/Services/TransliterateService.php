<?php

namespace App\Services;
use Illuminate\Support\Str;
use Transliterate as Transliterator;

class TransliterateService implements TransliterateInterface
{

    public function transliterate(string $string) : string
    {
        return Transliterator::slugify($string);
    }

    public function transliterateClientName(string $filename, string $extension): string
    {
        return $this->transliterate($filename) . '.' . $extension;
    }

    public function toLower(string $filename) : string
    {
        return Str::lower($filename);
    }
}
