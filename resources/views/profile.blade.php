@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="container">
        <h2>User Profile</h2>
        <!-- Profile Update Form -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control"
                    required>
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="form-control" required>
            </div>

            <div class="form-group">
                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username"
                    name="username" value="{{ old('username', $user->username) }}">
                @error('username')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="Mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="Mobile" name="mobile" placeholder="Enter Mobile address"
                    value="{{ old('mobile', $user->mobile) }}">
                @error('mobile')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
