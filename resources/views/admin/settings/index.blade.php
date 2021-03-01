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
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Tên hiển thị</th>
                    <th>Giá trị</th>
                    <th>Ngày cập nhật</th>
                </tr>
                <tbody>
                @forelse($list as $item)
                    <tr>
                        <td>
                            <a href="{{route($controller->name . '.edit', [$item])}}">{{$item->name}}</a>
                        </td>
                        <td>{{$item->display_name}}</td>
                        <td>{{$item->setting_value}}</td>
                        <td>{{$item->created_at->format('d-m-Y H:i')}}</td>
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
