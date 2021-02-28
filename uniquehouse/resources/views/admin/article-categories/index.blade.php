@extends('layouts.admin')

@push('page-title', 'Chủ đề bài viết')

@section('page-content')

    <h1>@stack('page-title')</h1>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <span>Tổng số: {{$list->count()}} mẫu tin</span>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route($controller->name . '.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tạo mới</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th>Tên hiển thị</th>
                    <th>Số bài viết</th>
                    <td class="text-end"><i class="fas fa-bars"></i></td>
                </tr>
                <tbody>
                @forelse($list as $item)
                    <tr>
                        <td class="text-right">{{$item->id}}</td>
                        <td>
                            <a href="{{route($controller->name . '.edit', [$item])}}">{{$item->display_name}}</a>
                        </td>
                        <td>{{$item->articles_count}}</td>
                        <td class="text-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteRow{{$item->id}}Modal" class="text-danger">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            @include($controller->view . '.delete-modal', ['needle'=>$item])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
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
