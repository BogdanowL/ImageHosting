<?php

namespace App\Services;


interface SaveHelperInterface
{
    public function getSavePath(string $extension) : string;

    public function getOnlyName(string $name) : string;

}
