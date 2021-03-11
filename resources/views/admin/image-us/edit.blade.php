@extends('layouts.admin')

@push('page-title', 'Hình ảnh giới thiệu')

@section('page-content')
    <h1>@stack('page-title')</h1>

    <form id="createForm" action="{{route($controller->name . '.update', [$needle->id])}}" method="post" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <input type="hidden" name="redirect" value="{{session('redirect', route($controller->name . '.index'))}}">
        <div class="card">
            <div class="card-header">
                <h5>Chỉnh sửa hình ảnh</h5>
            </div>
            <div class="card-body">
                @include('layouts.inc.alerts')
                
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
