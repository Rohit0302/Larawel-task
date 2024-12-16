@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Change Password</h2>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <!-- Old Password -->
            <div class="form-group position-relative">
                <label for="old_password">Old Password <span class="text-danger">*</span></label>
                <input type="password" id="old_password" name="old_password" class="form-control"
                    value="{{ old('old_password') }}" placeholder="Enter Old Password">

                <span class="eye-icon position-absolute" style="top: 35%; right: 10px; font-size: 20px;"
                    onclick="togglePassword('old_password')">
                    <i id="eye-icon-old_password" class="fas fa-eye"></i>
                </span>

                @error('old_password')
                    <div class="error-message text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="form-group position-relative">
                <label for="password">New Password <span class="text-danger">*</span></label>
                <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}"
                    placeholder="Enter New Password">

                <span class="eye-icon position-absolute" style="top: 35%; right: 10px; font-size: 20px;"
                    onclick="togglePassword('password')">
                    <i id="eye-icon-password" class="fas fa-eye"></i>
                </span>

                @error('password')
                    <div class="error-message text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="form-group position-relative">
                <label for="password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    value="{{ old('password_confirmation') }}" placeholder="Enter Confirm New Password">

                <span class="eye-icon position-absolute" style="top: 35%; right: 10px; font-size: 20px;"
                    onclick="togglePassword('password_confirmation')">
                    <i id="eye-icon-password_confirmation" class="fas fa-eye"></i>
                </span>

                @error('password_confirmation')
                    <div class="error-message text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Change Password</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Toggle Password Visibility
        function togglePassword(fieldId) {
            var passwordField = document.getElementById(fieldId);
            var eyeIcon = document.getElementById('eye-icon-' + fieldId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
