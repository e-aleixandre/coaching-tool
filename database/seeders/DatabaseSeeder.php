<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Maria";
        $user->email = "email@example.com";
        $user->password = Hash::make("password");
        $user->save();

        \App\Models\Client::factory(10)->create()
            ->each(function ($client) {
                if ($client->isCreated)
                {
                    \App\Models\Note::factory(2)->create(['client_id' => $client->id]);
                }
            });
    }
}
