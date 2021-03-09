@extends('layouts.admin')

@push('page-title', 'Bài viết Dịch vụ')

@section('page-content')

    <h1>@stack('page-title')</h1>
    @include('layouts.inc.alerts')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <span>Tổng số: {{$list->count()}} mẫu tin</span>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route($controller->name . '.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật</th>
                    <td class="text-end"><i class="fas fa-bars"></i></td>
                </tr>
                <tbody>
                @forelse($list as $item)
                    <tr>
                        <td class="text-right">{{$item->id}}</td>
                        <td>
                            <a href="{{route($controller->name . '.edit', [$item])}}">{{$item->title}}</a>
                        </td>
                        <td>{{$item->show=='Y'?'Hiển thị':'Ẩn'}}</td>
                        <td>{{$item->created_at->format('d-m-Y H:i')}}</td>
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
