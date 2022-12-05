<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageSaver extends ImageSaverService
{

    public function store(string $savePath) : void
    {
        Storage::disk('local')->put(Image::IMAGE_DIR . $savePath, file_get_contents($this->picture));
    }
}
