<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Visa Consultancy - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-style: italic;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Toast Alerts -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        @if (session('success'))
            <div class="toast show bg-success text-white custom-alert ">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast show bg-danger text-white custom-alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif
    </div>

    <div class="container-fluid vh-100">
        <div class="row h-100">

            <!-- LEFT LOGIN -->
            <div class="col-lg-6 col-md-7 d-flex align-items-center justify-content-center bg-white">

                <div class="w-50">

                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/visa-logo.webp') }}" width="80">
                    </div>

                    <h3 class="text-center mb-2 fw-bold">Login to Your Visa Portal</h3>
                    <p class="text-center text-muted mb-4">
                        Access your visa applications, document status and updates.
                    </p>

                    <!-- FORM -->
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password"
                                required>
                        </div>

                        <button class="btn btn-primary w-100 py-2 button">
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-4 text-muted small">
                        © Global Visa Consultancy — Making Your Dreams Fly ✈
                    </div>

                </div>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="col-lg-6 col-md-5 d-none d-md-block p-0">
                <div class="h-100"
                    style="background:url('{{ asset('assets/images/background/hire-visa-consultant.jpg') }}') center/cover no-repeat;">
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {


            // Auto dismiss flash messages
            // setTimeout(function() {
            //     $('.custom-alert').slideUp(500);
            // }, 3000);
        });
    </script>

</body>

</html>
