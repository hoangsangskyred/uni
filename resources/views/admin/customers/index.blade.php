@extends('layouts.admin')

@push('page-title', 'Danh sách khách hàng')


@section('page-content')

<h1>@stack('page-title')</h1>
<div class="card">
        <div class="card-header">
            <div class="row">
                 <div class="col-md-3">
                    <span>Tổng số: {{$list->total()}} Khách hàng</span>
                </div>
                 <div class="col-md-9">
                     <form action="{{route($controller->name.'.index')}}" method="get">
                        <div class="input-group  d-flex justify-content-end align-items-end">
                            <div class="justify-content-start d-flex align-items-start mr-2">
                                <select class="form-select" name="gender">
                                    <option value="">Chọn giới tính</option>
                                    <option value="1" @if( request('gender') == '1') ? selected @endif>nam</option>
                                    <option value="0" @if( request('gender') == '0') ? selected @endif>nữ</option>
                                </select>
                             </div>
                             <input type="text" class="form-control" placeholder="Tìm kiếm theo tên , email hoặc số điện thoại" 
                                   name="q"  id="search" size="40px" value="{{ request('q') }}"/>
                              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                              <a href="{{route($controller->name.'.index')}}" class="btn btn-outline-primary">Tất cả</a>
                              <a href="{{route($controller->name.'.create')}}" class="btn btn-success "><i class="fas fa-plus-circle"></i> Tạo mới</a>
                        </div>
                    </form>
                  </div>
            </div>
       </div>

        @include('admin.customers.master')
        
    </div>

@endsection

