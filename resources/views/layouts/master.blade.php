<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title style="color: 'black';">{{ config('app.name', 'ICP Student Management') }} - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">
    <div class="d-flex min-vh-100">

        @include('layouts.partials.sidebar')

        <div id="mainContent" class="flex-grow-1" style="margin-left: 250px;">
            @include('layouts.partials.header')
            <main class="p-4">
                @yield('content')
            </main>
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>