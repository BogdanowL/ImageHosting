<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;



abstract class ImageSaverService
{
    protected UploadedFile $picture;


    abstract public function store(string $savePath) : void;


    public function getPicture(): UploadedFile
    {
        return $this->picture;
    }

    public function setPicture(UploadedFile $picture): void
    {
        $this->picture = $picture;
    }

}
