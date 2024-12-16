<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered | E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for the eye icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('success'))
                    <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('fail'))
                    <div id="danger-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif;
                <h2 class="text-center">Sign In</h2>
                <form class="needs-validation" action="{{ url('/registration') }}" method="POST">
                    @csrf <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter full name" value="{{ old('name') }}">
                        @error('name')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Enter Email address" value="{{ old('email') }}">
                        @error('name')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter username" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="Mobile" name="mobile"
                            placeholder="Enter Mobile address" value="{{ old('mobile') }}">
                        @error('mobile')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field with Eye Icon -->
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter password" value="{{ old('password') }}">
                        <span class="eye-icon position-absolute" style="top: 35%; right: 10px; font-size: 20px;"
                            onclick="togglePassword('password')">
                            <i id="eye-icon-password" class="fas fa-eye"></i>
                        </span>
                        @error('password')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field with Eye Icon -->
                    <div class="mb-3 position-relative">
                        <label for="password_confirmation" class="form-label">Confirm Password <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Enter Confirm password"
                            value="{{ old('password_confirmation') }}">
                        <span class="eye-icon position-absolute" style="top: 35%; right: 10px; font-size: 20px;"
                            onclick="togglePassword('password_confirmation')">
                            <i id="eye-icon-password_confirmation" class="fas fa-eye"></i>
                        </span>
                        @error('password_confirmation')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary w-100">Registered</button>
                </form>
                <p class="mt-3 text-center">Don't have an account? <a href="{{ url('login') }}">Log In</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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

        // Auto-hide all session messages after 3 seconds and remove all flash message divs
        window.onload = function() {
            // Get all flash messages (success/fail etc.)
            const flashMessages = document.querySelectorAll('.alert');
            flashMessages.forEach(function(flashMessage) {
                setTimeout(function() {
                    // Fade out the alert message
                    flashMessage.classList.remove('show');
                    flashMessage.classList.add('fade');

                    // Remove the flash message div completely from the DOM
                    setTimeout(function() {
                        flashMessage.remove();
                    }, 500); // Wait for fade-out effect before removal
                }, 3000); // Wait for 3 seconds before removing
            });

            // Scroll to top of the page after 3 seconds if there were any flash messages
            setTimeout(function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }, 3000);
        };
    </script>
</body>

</html>
