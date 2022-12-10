<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private const COUNT_IMAGES = 10;
    private const STEP = 1;

    public function run()
    {
        // Just for fun
        $start = microtime(true);
        $countPictures = function($n) use (&$countPictures)
        {
            Image::factory()->definition();
            if($n==0)
                return true;
            return $countPictures($n - self::STEP);
        };
        $countPictures(self::COUNT_IMAGES);

        $finish = microtime(true);
        echo "Time spent: " . (int)($finish - $start)  . " seconds" . PHP_EOL;
    }
}

