<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="$1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MiniLoan - @yield('title')</title>
        <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
        @yield('css')
    </head>
    <body>
        <div class='container'>
            @yield('content')
        </div>
        
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        @yield('js')
    </body>
</html>