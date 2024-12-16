<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Commerce</title>
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
                <!-- Success or fail message -->
                @if (session('success'))
                    <div id="flash-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('fail'))
                    <div id="flash-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h2 class="text-center">Sign In</h2>
                <form action="{{ url('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ old('username') }}" placeholder="Enter username">
                        @error('username')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field with Eye Icon -->
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" placeholder="Enter password" id="password"
                            name="password" value="{{ old('password') }}">
                        <span class="eye-icon position-absolute" style="top: 35%; right: 10px; font-size: 20px;"
                            onclick="togglePassword()">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </span>
                        @error('password')
                            <div class="error-mesage text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                </form>
                <p class="mt-3 text-center">Don't have an account? <a href="{{ url('registration') }}">Registration</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password Visibility
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var eyeIcon = document.getElementById('eye-icon');

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
