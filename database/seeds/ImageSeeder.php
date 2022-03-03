<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 8; $i++) {
            $newImage = new Image();
            $newImage->name = $i + 1 . ".jpg";
            $newImage->url = $i + 1;
            $newImage->post_id = $i + 1;
            $newImage->save();
        }
    }
}
