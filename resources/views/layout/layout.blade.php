<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HMS - @yield('title', 'HMS')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-light">

    <!-- Loader -->
    <div id="globalLoader"
        class="d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center"
        style="z-index: 1055;">
        <div class="spinner-border text-light"></div>
    </div>

    <!-- Toast -->
    <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1080;"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">HMS</a>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-4 text-center">@yield('page-title')</h4>
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function showLoader() {
            $('#globalLoader').removeClass('d-none');
        }

        function hideLoader() {
            $('#globalLoader').addClass('d-none');
        }

        function showToast(message, type = 'success') {
            const toast = $(`
                <div class="toast align-items-center text-bg-${type === 'error' ? 'danger' : type} border-0 show mb-2">
                    <div class="d-flex">
                        <div class="toast-body">${message}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="$(this).closest('.toast').remove()"></button>
                    </div>
                </div>
            `);

            $('#toastContainer').append(toast);

            setTimeout(() => {
                toast.fadeOut(500, function() {
                    $(this).remove();
                });
            }, 3000);
        }

        function redirect(location = "/", timeOut = 500) {
            setTimeout(() => {
                window.location.href = location;
            }, timeOut);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
