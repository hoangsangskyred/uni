<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('admin._inc.page-head')

    @stack('extra-css')

    <title>@stack('page-title') | Unique House</title>
</head>
<body>

<div class="container-fluid p-0">
    <div class="sideBar position-absolute">
        @include('admin._inc.sideBar')
    </div>
    <div class="topBar">
        @include('admin._inc.topBar')
    </div>
    <div class="pageContent">
        @yield('page-content')
    </div>
</div>


@include('admin._inc.page-scripts')

@stack('extra-scripts')
</body>
</html>
