@extends('layouts.admin')

@push('page-title', 'Thông tin chung')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <form id="createForm" action="{{route($controller->name . '.update', [$needle])}}" method="post" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h5>Thay đổi giá trị</h5>
            </div>
            <div class="card-body">
                @include('layouts.inc.alerts')

                @include($controller->view . '.model', ['needle' => $needle])
            </div>
            <div class="card-footer"></div>
        </div>
    </form>

@stop
