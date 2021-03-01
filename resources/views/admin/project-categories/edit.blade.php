@extends('layouts.admin')

@push('page-title', 'Chủ đề bài viết')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <div class="row">
        <div class="col-md-4">
            <form action="{{route($controller->name . '.update', [$needle])}}" method="post" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <input type="hidden" name="redirect" value="{{session('redirect', route($controller->name . '.index'))}}">
                <div class="card">
                    <div class="card-header">
                        <h5>Chỉnh sửa bài viết</h5>
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
        </div>
    </div>

@stop
