@extends('layouts.admin')

@push('page-title', 'Quản lý Tài khoản')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <form id="createForm" action="{{route($controller->name . '.update', [$needle])}}" method="post" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h5>Cập nhật tài khoản</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @include('layouts.inc.alerts')

                        @include($controller->view . '.model', ['needle' => $needle])
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-4 text-end">
                        <button type="submit" class="btn btn-theme px-5">
                            Lưu
                        </button>
                        <a href="{{ $controller->getRedirectLink() }}" class="btn btn-secondary">
                            Thoát
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
