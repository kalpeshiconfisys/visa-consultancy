<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/visa-logo.webp') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/portal.css') }}" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" rel="stylesheet">

    @stack('css')
</head>

<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 99999;">
    @if (session('success'))
        <div class="toast align-items-center text-white bg-success border-0 show custom-alert" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="toast align-items-center text-white bg-danger border-0 show custom-alert" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
</div>

<body>
    <div class="d-flex">
        @include('admin.layouts.sidebar')
        <div class="sidebar-overlay"></div>
        <div class="main-content">
            @include('admin.layouts.header')
            @yield('content')
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            if ($("#example tbody tr").not(':has(td[colspan])').length > 0) {
                $('#example').DataTable({
                    paging: false,
                    searching: true,
                    ordering: true,
                    info: true,
                    language: {
                        search: "Search:",
                        emptyTable: "No data available"
                    },
                    dom: '<"d-flex align-items-center justify-content-start"f>t<"d-flex justify-content-between"ip>'
                });
            }
            setTimeout(function() {
                $('.custom-alert').slideUp(500);
            }, 3000);
        });
    </script>
    @stack('script')
</body>

</html>
