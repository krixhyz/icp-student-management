<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
{
    public function run()
    {
        $students = User::where('role', 'student')->get();

        foreach ($students as $student) {
            // Example: Generate attendance for last 5 days
            for ($i = 0; $i < 5; $i++) {
                Attendance::create([
                    'student_id' => $student->id,
                    'date' => Carbon::now()->subDays($i)->format('Y-m-d'),
                    'present' => (bool)random_int(0, 1), // random present/absent
                ]);
            }
        }
    }
}
