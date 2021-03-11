@extends('layouts.admin')

@push('page-title', 'Quản lý Bài viết')

@section('page-content')

    <h1>@stack('page-title')</h1>
    @include('layouts.inc.alerts')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                   <span>Tổng số: {{$list->total()}} mẫu tin</span>
               </div>
                <div class="col-md-9">
                    <form action="{{route($controller->name.'.index')}}" method="get">
                       <div class="input-group  d-flex justify-content-end align-items-end">
                           <div class="justify-content-start d-flex align-items-start mr-2">
                               <select class="form-select" name="display_name">
                                   <option value="">Chọn Chủ đề</option>
                                @foreach ($articleCategories as $articleCategory)
                                    <option value="{{$articleCategory->id}}" @if( request('display_name') == $articleCategory->id ) ? selected @endif>{{ $articleCategory->display_name }}</option> 
                                @endforeach
                                </select>
                            </div>
                            <input type="text" class="form-control" placeholder="Tìm kiếm theo tiêu đề hoặc chủ đề" 
                                  name="q"  id="search" size="40px" value="{{ request('q') }}"/>
                             <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                             <a href="{{route($controller->name.'.index')}}" class="btn btn-outline-primary">Tất cả</a>
                             <a href="{{route($controller->name.'.create')}}" class="btn btn-success "><i class="fas fa-plus-circle"></i> Tạo mới</a>
                       </div>
                   </form>
                 </div>
           </div>
           
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th>Tiêu đề</th>
                    <th>Chủ đề</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật</th>
                    <td class="text-end"><i class="fas fa-bars"></i></td>
                </tr>
                <tbody>
                @forelse($list as $item)
                
                    <tr>
                        <td class="text-right">{{$item->id}}</td>
                        <td>
                            <a href="{{route($controller->name . '.edit',$item->id)}}">{{$item->title}}</a>
                        </td>
                        <td>{{$item->category->display_name}}</td>
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
                        <td colspan="6">
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
    <div class="pagination justify-content-center">
        {{$list->links()}}   
     </div>
@stop
