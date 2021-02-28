<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('layouts.inc.page-head')

    @stack('extra-css')

    <title>@stack('page-title') | Unique House</title>
</head>
<body>
<!-- Top menu start -->
<div class="header-wrap">
    <div class="container">
        @include('layouts.inc.top-nav')
    </div>
</div>
<!-- Top menu end -->

@yield('page-content')

@include('layouts.inc.page-footer')

@include('layouts.inc.page-scripts')

@stack('extra-scripts')
</body>
</html>
