<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     TweetSeeder::class
        // ]);
        \App\Models\Tweet::factory(50)->create();

        \App\Models\User::factory(5)->create(['user_id' => $this->user->id]);
    }
}
