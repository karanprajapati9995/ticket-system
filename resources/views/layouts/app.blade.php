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

    <style>
        body { font-family: system-ui, sans-serif; }
        .card { transition: all 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-light">
    <div class="min-vh-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow-sm py-3">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="container py-4">
            {{ $slot }}
        </main>
    </div>
</body>
</html>