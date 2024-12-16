<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    @include('partials.navbar')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close flash-alert" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close flash-alert" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @elseif(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close flash-alert" data-bs-dismiss="alert"
                    aria-label="Close"></button>

            </div>
        @endif
        <div id="message"></div>
        <!-- Main Content -->

        @yield('content')
    </div>

    <!-- Footer Section -->
    <footer class="text-center mt-5">
        <p>&copy; 2024 Your Company</p>
    </footer>

    <!-- Bootstrap JS -->
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
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
@yield('scripts')
