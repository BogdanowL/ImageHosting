<?php

namespace App\Http\Requests;


use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class UploadImageData extends Data
{
    public function __construct(public UploadedFile $picture)
    {
    }

}
