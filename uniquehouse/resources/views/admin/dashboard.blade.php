@extends('layouts.admin')

@push('page-title', 'Khu vực quản trị')

@section('page-content')
    <h1>@stack('page-title')</h1>

    @include('layouts.inc.alerts')

    @stop
