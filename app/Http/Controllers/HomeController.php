<?php

namespace App\Http\Controllers;

use App\Models\Image;

class HomeController extends Controller
{
    private Image $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function sortByName()
    {
        $images = $this->image->orderBy('client_name')->get();
        return view('image.index', compact('images'));
    }

    public function sortByTime()
    {
        $images = $this->image->orderBy('created_at', 'desc')->get();
        return view('image.index', compact('images'));
    }
}
