<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/registration') }}">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container text-center mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1>Welcome to Our Website!</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda reprehenderit voluptatibus ratione
            explicabo distinctio nostrum porro necessitatibus voluptate odio! Inventore similique error quos ad repellat
            exercitationem accusamus quibusdam quisquam cum, explicabo asperiores assumenda laborum, obcaecati earum
            iusto voluptates molestias. Cum consequatur dolorem nisi porro quis earum sapiente rem laboriosam provident.
        </p>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
