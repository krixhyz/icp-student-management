<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    \App\Models\User::factory(10)->create(); // optional if you want
    $this->call([
        UsersTableSeeder::class,
        AttendancesTableSeeder::class,
    ]);
}
}
