<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/assets/css/main/app.css">
    <link rel="stylesheet" href="/assets/css/pages/auth.css">
    <link rel="shortcut icon" href="/assets/images/logo/favicon.ico" type="image/x-icon">
</head>

<body>
    <div id="auth">
        @yield('content')
    </div>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
</body>

</html>
