<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ticket System') }}</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h1 class="fw-bold text-primary">🎟️ Ticket System</h1>
                                <p class="text-muted">Login to continue</p>
                            </div>
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>