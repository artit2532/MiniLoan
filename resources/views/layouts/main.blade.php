<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="$1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MiniLoan - @yield('title')</title>
        <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        @yield('css')
    </head>
    <body>
        @if(Session::has('status'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{Session::get('status')}}</strong>
            </div>
        @endif
        <div class='container'>
            @yield('content')
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        @yield('js')
    </body>
</html>