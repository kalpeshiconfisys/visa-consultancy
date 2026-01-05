<!DOCTYPE html>
<html lang="en">
<head>
    <title>Visa Consultancy - 404</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Visa Consultancy Admin Dashboard">
    <meta name="author" content="Your Company">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .app-card {
            border-radius: 1rem;
        }
        .page-title {
            font-size: 4rem;
        }
        .font-weight-light {
            font-weight: 300;
        }
        .app-btn-primary {
            background-color: #0d6efd;
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
        }
        .app-btn-primary:hover {
            background-color: #0b5ed7;
            color: #fff;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>

<div class="container mb-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7 col-xl-6 text-center">

            <!-- Branding -->
            <div class="mb-5">
                <a href="{{ url('admin/') }}" class="d-inline-block mb-4">
                    <img src="{{ asset('assets/images/visa-logo.webp') }}" alt="Visa Logo" class="img-fluid" style="max-height: 80px;">
                </a>
            </div>

            <!-- 404 Card -->
            <div class="card p-5 shadow-sm app-card">
                <h1 class="page-title mb-4">404<br><span class="font-weight-light">Page Not Found</span></h1>
                <p class="mb-4 text-muted">Sorry, we can't find the page you're looking for.</p>
                <a class="app-btn-primary" href="{{ url('admin/') }}">Go to Home Page</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3">
    <small class="text-muted">
        Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a href="#" target="_blank">Your Company</a>
    </small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
