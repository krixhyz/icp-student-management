@extends('layouts.master')
@section('title', 'Register')
@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Register</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="student" selected>Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ route('login.show') }}" class="btn btn-link">Already have an account?</a>
            </form>
        </div>
    </div>
</div>
@endsection
