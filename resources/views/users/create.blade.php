@extends('layouts.master')
@section('title', 'Create User')
@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Create User</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" class="border-gray-300 rounded w-full p-2" value="{{ old('name') }}">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="border-gray-300 rounded w-full p-2" value="{{ old('email') }}">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" class="border-gray-300 rounded w-full p-2">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="border-gray-300 rounded w-full p-2">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium">Role</label>
                <select name="role" id="role" class="border-gray-300 rounded w-full p-2">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
                @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded">Create</button>
        </form>
    </div>
@endsection