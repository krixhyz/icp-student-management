<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Teacher account
        User::create([
            'name' => 'Teacher One',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Students
        User::factory()->count(10)->create([
            'role' => 'student',
        ]);
    }
}
