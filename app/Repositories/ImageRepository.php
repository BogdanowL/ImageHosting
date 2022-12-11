<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    public function sortByName()
    {
        return Image::orderBy(Image::CLIENT_NAME)->get();
    }

    public function sortByTime()
    {
        return Image::orderBy('created_at', 'desc')->get();
    }
}
