<?php

namespace App\Providers;

use App\Models\Image;
use App\Services\SaveHelper;
use App\Services\SaveHelperInterface;
use App\Services\TransliterateInterface;
use App\Services\TransliterateService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SaveHelperInterface::class, SaveHelper::class);
        $this->app->bind(TransliterateInterface::class, TransliterateService::class);
    }

    public function boot()
    {
        //
    }
}
