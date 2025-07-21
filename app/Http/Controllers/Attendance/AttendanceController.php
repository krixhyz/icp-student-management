<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'student') {
        $attendances = Attendance::where('student_id', $user->id)->orderBy('date', 'desc')->get();
        return view('attendances.index', [
            'attendances' => $attendances,
            'students' => collect(), // empty collection to avoid undefined
        ]);
    } else {
        $students = User::where('role', 'student')->with('attendances')->get();

        // dd($students);
        return view('attendances.index', [
            'students' => $students,
            'attendances' => collect(), // empty collection to avoid undefined
        ]);
    }
}


    public function markAllPresent(Request $request)
{
    $request->validate([
        'date' => 'required|date',
    ]);

    $date = Carbon::parse($request->input('date'))->toDateString();
    $students = User::where('role', 'student')->get();

    foreach ($students as $student) {
        Attendance::updateOrCreate(
            ['student_id' => $student->id, 'date' => $date],
            ['present' => true]
        );
    }

    return redirect()->route('attendances.index')->with('success', "All students marked present for $date.");
}

}