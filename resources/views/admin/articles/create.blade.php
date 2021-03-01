@extends('layouts.admin')

@push('page-title', 'Quản lý Bài viết')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <form id="createForm" action="{{route($controller->name . '.store')}}" method="post" class="needs-validation" novalidate>
        @csrf
        <input type="hidden" name="redirect" value="{{session('redirect', route($controller->name . '.index'))}}">
        <div class="card">
            <div class="card-header">
                <h5>Thêm mới</h5>
            </div>
            <div class="card-body">
                @include('layouts.inc.alerts')

                @include($controller->view . '.model', ['needle' => $needle])
            </div>
            <div class="card-footer d-flex">
                <a href="#" data-bs-toggle="modal" data-bs-target="#crawlModal" class="btn btn-primary me-auto">
                    <i class="fas fa-cloud-download"></i> Nhập nội dung website khác
                </a>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-theme px-5">
                        Lưu
                    </button>
                    <a href="{{ $controller->getRedirectLink() }}" class="btn btn-secondary">
                        Thoát
                    </a>
                </div>
            </div>
        </div>
    </form>
    @include($controller->view . '.crawl-modal')
@stop
