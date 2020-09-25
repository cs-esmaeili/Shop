<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>چی مارکت</title>
    <link href="{{ asset('/resources/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    @yield('head')
</head>
<body>
@include('partials.header')

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-10 col-md-8 col-12">
        @yield('content')
    </div>
</div>
@include('partials.footer')
</body>
<script src="{{ asset('/resources/jquery/jquery.slim.min.js') }}"></script>
<script src="{{ asset('/resources/jquery/popper.min.js') }}"></script>
<script src="{{ asset('/resources/js/bootstrap.min.js') }}"></script>
@yield('script')
</html>

