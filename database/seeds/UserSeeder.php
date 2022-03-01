<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();
        $newUser->name = "John";
        // $newUser->surname = "Pem";
        $newUser->email = "admin@admin.com";
        $newUser->password = Hash::make("Admin");
        $newUser->save();

        Factory(User::class, 4)->create();
    }
}
