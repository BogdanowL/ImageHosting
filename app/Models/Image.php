<?php

namespace App\Models;

use App\Services\ThumbnailSaver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    public const IMAGE_DIR = 'images/';
    public const THUMB = 'thumb_';

    public const CLIENT_NAME = 'client_name';

    use HasFactory;

    protected $fillable = [
        'path',
        'client_name',
    ];

    public function getPath() : string
    {
        return $this->path;
    }

    public function setPath(string $path) : void
    {
        $this->path = $path;
    }

    public function getThumbnailPath() : string
    {
        return $this->path . self::THUMB;
    }

    public function getClientName() : string
    {
        return $this->client_name;
    }

    public function setClientName(string $clientImageName) : void
    {
        $this->client_name = $clientImageName;
    }

    public function getImage() : string
    {
        return asset(self::IMAGE_DIR . $this->path);
    }

    public function getThumbnailImage() : string
    {
        return asset(self::IMAGE_DIR . self::THUMB . $this->path);
    }

}
