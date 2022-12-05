<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Models\Image;
use App\Services\ImageSaver;
use App\Services\SaveHelperInterface;
use App\Services\ThumbnailSaver;
use App\Services\TransliterateInterface;
use Illuminate\Http\RedirectResponse;


class ImageController extends Controller
{

    private Image $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function index()
    {
        $images = $this->image->all();

        return view('image.index', compact('images'));
    }

    public function create()
    {
        return view('image.create');
    }

    public function store(UploadImageRequest     $request,
                          ImageSaver             $imageSaver,
                          ThumbnailSaver         $thumbnailSaver,
                          SaveHelperInterface    $saveHelper,
                          TransliterateInterface $transliteration): RedirectResponse
    {
        $isImages = $request->hasFile('images');
        if ($isImages) {
            foreach($request->file('images') as $picture){

                  $pictureName = $saveHelper->getOnlyName($picture->getClientOriginalName());
                  $extension = $picture->getClientOriginalExtension();
                  $savePath = $saveHelper->getSavePath($extension);
                  $transliterate = $transliteration->transliterateClientName($pictureName, $extension);
                  $clientName = $transliteration->toLower($transliterate);

                  $imageSaver->setPicture($picture);
                  $imageSaver->store($savePath);
                  $thumbnailSaver->store($savePath);

                  $image = app()->make(Image::class);
                  $image->setPath($savePath);
                  $image->setClientName($clientName);
                  $image->save();

            }
        }

        return redirect()->back()->with('success', 'Изображение успешно загружено');
    }
}
