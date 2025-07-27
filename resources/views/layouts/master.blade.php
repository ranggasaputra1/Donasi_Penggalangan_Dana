<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @yield('stylefirst')
    <link rel="stylesheet" href="/assets/css/main/app.css">
    <link rel="stylesheet" href="/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="/assets/images/logo/favicon.ico" type="image/x-icon">
    @yield('style')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            @include('layouts.sidebar')
        </div>
        <div id="main" class="layout-navbar navbar-fixed">
            <header class="mb-3">
                @include('layouts.navbar')
            </header>
            <div id="main-content">
                @yield('content')
                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-end">
                            <p><?php echo date('Y'); ?> &copy; We Care</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="/assets/js/initTheme.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/app.js"></script>
    @yield('script')
</body>

</html>
