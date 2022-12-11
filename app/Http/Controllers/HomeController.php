<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;

class HomeController extends Controller
{
    public function __construct(private ImageRepository $repository)
    {
    }

    public function sortByName()
    {
        $images = $this->repository->sortByName();
        return view('image.index', compact('images'));
    }

    public function sortByTime()
    {
        $images = $this->repository->sortByTime();
        return view('image.index', compact('images'));
    }
}
