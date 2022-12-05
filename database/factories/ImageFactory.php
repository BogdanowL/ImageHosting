<?php

namespace Database\Factories;

use App\Models\Image;
use App\Services\ImageSaver;
use App\Services\SaveHelperInterface;
use App\Services\ThumbnailSaver;
use App\Services\TransliterateInterface;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Storage;

class ImageFactory extends Factory
{
    private const EXAMPLES_DIR = 'examples/';
    private array $examples;

    private Image $image;
    private ImageSaver $imageSaver;
    private ThumbnailSaver $thumbnailSaver;
    private SaveHelperInterface $saveHelper;
    private TransliterateInterface $transliteration;

    public function __construct($count = null,
                                ?Collection $states = null,
                                ?Collection $has = null,
                                ?Collection $for = null,
                                ?Collection $afterMaking = null,
                                ?Collection $afterCreating = null,
                                $connection = null)

    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);

        $this->examples = $this->getExampleFiles();
        $this->image = app()->make(Image::class);
        $this->imageSaver = app()->make(ImageSaver::class);
        $this->thumbnailSaver = app()->make(ThumbnailSaver::class);
        $this->saveHelper = app()->make(SaveHelperInterface::class);
        $this->transliteration = app()->make(TransliterateInterface::class);
    }

    public function definition(): array
    {
            $picture = $this->getPicture();
            $pictureName = $this->saveHelper->getOnlyName($picture->getClientOriginalName());
            $extension = $picture->getClientOriginalExtension();
            $savePath = $this->saveHelper->getSavePath($extension);
            $transliterate = $this->transliteration->transliterateClientName($pictureName, $extension);
            $clientName = $this->transliteration->toLower($transliterate);

            $this->imageSaver->setPicture($picture);
            $this->imageSaver->store($savePath);
            $this->thumbnailSaver->store($savePath);

            $this->image->setPath($savePath);
            $this->image->setClientName($clientName);

        return [
            'path' => $this->image->getPath(),
            'client_name' => $this->image->getClientName()
        ];
    }

    public function getExampleFiles() : array
    {
        return Storage::disk('local')->allFiles(self::EXAMPLES_DIR);
    }

    private function getPicture() : UploadedFile
    {
        $filesystem = new Filesystem;
        $path = Storage::disk('local')->path($this->examples[random_int(0,2)]);
        $name = $filesystem->name( $path );
        $extension = $filesystem->extension( $path );
        $originalName = $name . '.' . $extension;
        $mimeType = $filesystem->mimeType( $path );
        $error = null;

        return new UploadedFile( $path, $originalName, $mimeType, $error, true );
    }
}
