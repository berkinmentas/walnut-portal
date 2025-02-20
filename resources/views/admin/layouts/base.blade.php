<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>
        @hasSection('title')
            @yield('title') WALNUT
        @else
            WALNUT Portal
        @endif
    </title>
    @vite(['resources/admin/js/app.js'])
</head>
<body>
@yield('body')

@stack('js-stack')
</body>
</html>

