<?php

namespace Database\Factories;

use App\Http\Requests\UploadImageRequest;
use App\Models\Image;
use App\Services\ImageCreate;
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

    public function definition(): array
    {
            $this->examples = $this->getExampleFiles();
            $picture = $this->getPicture();

            $dto = app(UploadImageRequest::class)->data($picture);

            $image = app(ImageCreate::class)->create($dto);

        return [
            'path' => $image->getPath(),
            'client_name' => $image->getClientName()
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
