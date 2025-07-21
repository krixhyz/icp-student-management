@extends('layouts.master')
@section('title', 'Login')
@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Login</button>
                <a href="{{ route('register.show') }}" class="btn btn-link">Don't have an account?</a>
            </form>
        </div>
    </div>
</div>
@endsection
