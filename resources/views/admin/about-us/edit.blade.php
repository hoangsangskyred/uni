@extends('layouts.admin')

@push('page-title', 'Bài giới thiệu công ty')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <form id="aboutUsForm" action="{{route($controller->name . '.update', $needle->id)}}" method="post" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">

                @include($controller->view . '.model', ['needle' => $needle])

            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-theme px-5">
                    Lưu
                </button>
                <a href="{{ $controller->getRedirectLink() }}" class="btn btn-secondary">
                    Thoát
                </a>
            </div>
        </div>
    </form>

@stop
