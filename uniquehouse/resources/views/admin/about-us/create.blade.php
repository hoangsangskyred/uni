@extends('layouts.admin')

@push('page-title', 'Bài giới thiệu công ty')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <form id="createForm" action="{{route($controller->name . '.store')}}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="card">
            <div class="card-body">

                @include($controller->view . '.model', ['needle' => $needle])

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 mx-auto text-end">
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
