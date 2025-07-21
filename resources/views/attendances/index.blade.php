@extends('layouts.master')
@section('title', 'Attendance')
@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Attendance</h1>

        @if(Auth::user()->role !== 'student')
            {{-- Mark All Present Form --}}
            <form action="{{ route('attendances.markAll') }}" method="POST" class="mb-6 flex items-center space-x-4">
                @csrf
                <label for="date" class="text-sm font-medium">Select Date:</label>
                <input type="date" name="date" id="date" required class="border rounded px-2 py-1">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-black px-4 py-2 rounded">
                    Mark All Students Present
                </button>
            </form>

            {{-- Attendance Summary Table --}}
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Student</th>
                        <th class="border p-2">Total Days</th>
                        <th class="border p-2">Present Days</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td class="border p-2">{{ $student->name }}</td>
                            <td class="border p-2">{{ $student->attendances->count() }}</td>
                            <td class="border p-2">{{ $student->attendances->where('present', true)->count() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border p-2 text-center text-gray-500">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            {{-- Student’s own attendance --}}
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Date</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td class="border p-2">{{ $attendance->date }}</td>
                            <td class="border p-2">{{ $attendance->present ? 'Present' : 'Absent' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="border p-2 text-center text-gray-500">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection
