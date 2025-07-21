@extends('layouts.master')
@section('title', 'Edit User')
@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" class="border-gray-300 rounded w-full p-2" value="{{ $user->name }}">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="border-gray-300 rounded w-full p-2" value="{{ $user->email }}">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium">Role</label>
                <select name="role" id="role" class="border-gray-300 rounded w-full p-2">
                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                    <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Teacher</option>
                </select>
                @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection