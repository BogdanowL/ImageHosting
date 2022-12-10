<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class ImageCreate
{
    private UploadedFile $picture;

    private string $savePath;

    private string $clientName;

    public function __construct(private ImageSaver $imageSaver,
                                private SaveHelperInterface $saveHelper,
                                private ThumbnailSaver $thumbnailSaver,
                                private TransliterateInterface $transliteration,)

    {
    }

    public function create(Data $dto) : Image
    {
        $this->picture = $dto->picture;

        $this->prepareToSave();
        $this->storeImage();

        $image = app(Image::class);
        $image->setPath($this->savePath);
        $image->setClientName($this->clientName);
        $image->save();

        return $image;
    }

    public function prepareToSave() : void
    {
        $pictureName = $this->saveHelper->getOnlyName($this->picture->getClientOriginalName());
        $extension = $this->picture->getClientOriginalExtension();
        $this->savePath = $this->saveHelper->getSavePath($extension);
        $transliterate = $this->transliteration->transliterateClientName($pictureName, $extension);
        $this->clientName = $this->transliteration->toLower($transliterate);
    }

    private function storeImage() : void
    {
        $this->imageSaver->setPicture($this->picture);
        $this->imageSaver->store($this->savePath);
        $this->thumbnailSaver->store($this->savePath);
    }

}
