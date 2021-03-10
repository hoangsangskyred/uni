@extends('layouts.admin')

@push('page-title', 'Thông tin chung')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <span>Tổng số: {{$list->count()}} mẫu tin</span>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route($controller->name . '.create')}}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus-circle"></i> Tạo tài khoản
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.inc.alerts')
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Họ tên</th>
                    <th>E-mail</th>
                    <th>Vai trò</th>
                    <th class="text-center">Đăng nhập lần cuối</th>
                    <th class="text-end"><i class="fas fa-bars"></i></th>
                </tr>
                <tbody>
                @forelse($list as $item)
                    <tr>
                        <td>
                            <a href="{{route($controller->name . '.edit', [$item])}}">{{$item->name}}</a>
                        </td>
                        <td>{{$item->email}}</td>
                        <td>{{implode(', ', $item->roles->pluck('display_name')->toArray())}}</td>
                        <th class="text-center">
                            {{$item->last_login_at ? $item->last_login_at->format('d-m-Y H:i:S') : '-'}}
                        </th>
                        <td class="text-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteRow{{$item->id}}Modal" class="text-danger">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            @include($controller->view . '.delete-modal', ['needle'=>$item])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-danger mb-0">
                                <i class="fas fa-exclamation-circle"></i> Không có mẫu tin nào
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                </thead>
            </table>
        </div>
    </div>

@stop
