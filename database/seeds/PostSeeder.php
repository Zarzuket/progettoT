<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i<20; $i++){
            $newPost = new Post();
            $newPost->user_id = $faker->numberBetween(1,5);
            $newPost->title = $faker->words(5,true);
            $newPost->slug = Str::of($newPost->title)->slug('-');
            $newPost->description = $faker->text(70);
            $newPost->save();
        }
    }
}
