<!DOCTYPE html>
<html>
<head>
    <title>Mini Accounting Journal</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    @yield('styles')
</head>
<body>
    @include('partials.sidebar')

    <!-- Main content with left margin to avoid sidebar -->
    <div class="main-content">
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
