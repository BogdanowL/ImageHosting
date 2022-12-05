<?php

namespace App\Services;

use App\Models\Image;
use Intervention\Image\Facades\Image as ThumbnailMaker;
use Storage;

class ThumbnailSaver extends ImageSaverService
{
    private const WIDTH = 100;
    private const HEIGHT = 80;

    public function store(string $path) : void
    {
        $this->createThumbnail($path);
    }

    public function createThumbnail(string $path) : void
    {
        $pathToOriginImage = Storage::disk('local')->path(Image::IMAGE_DIR . $path);
        $pathToThumbImage = Storage::disk('local')->path(Image::IMAGE_DIR . Image::THUMB . $path);

        $img = ThumbnailMaker::make($pathToOriginImage)->resize(self::WIDTH, self::HEIGHT, function ($constraint){
            $constraint->aspectRatio();
        });
        $img->save($pathToThumbImage);
    }
}
