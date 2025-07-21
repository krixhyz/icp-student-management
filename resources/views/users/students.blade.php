@extends('layouts.master')
@section('title', 'Students')
@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Students</h1>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td class="border p-2">{{ $student->name }}</td>
                        <td class="border p-2">{{ $student->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection