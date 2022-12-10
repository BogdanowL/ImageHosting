<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Models\Image;
use App\Services\ImageCreate;
use App\Services\ImageSaver;
use App\Services\SaveHelperInterface;
use App\Services\ThumbnailSaver;
use App\Services\TransliterateInterface;
use Illuminate\Http\RedirectResponse;


class ImageController extends Controller
{

    public function index()
    {
        $images = Image::all();

        return view('image.index', compact('images'));
    }

    public function create()
    {
        return view('image.create');
    }

    public function store(UploadImageRequest $request) : RedirectResponse
    {
        $isImage = $request->hasFile('images');
        if (!$isImage) return redirect()->back();

        $images = $request->file('images');
        foreach($images as $picture)
        {
              $dto = $request->data($picture);
              app(ImageCreate::class)->create($dto);
        }

        return redirect()->back()->with('success', 'Изображение успешно загружено');
    }
}
