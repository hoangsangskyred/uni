@extends('layouts.admin')

@push('page-title', 'Thêm khách hàng')

@section('page-content')

<h1>@stack('page-title')</h1>

<form id="createForm" action="{{route( $name.'.store')}}" method="post" class="needs-validation" novalidate>
    @csrf
    <div class="card">
        <div class="card-header">
            <h5>Thêm mới</h5>
        </div>
        <div class="card-body">
            @include('layouts.inc.alerts')
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control text-capitalize" id="first_name" name="first_name" placeholder="First Name" value="{{old('first_name')}}" required >
                                <label for="first_name" style="top:10px !important; padding:0 !important">Tên</label>
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control text-capitalize" id="last_name" name="last_name" placeholder="Last Name" value="{{old('last_name')}}" required >
                                <label for="last_name" style="top:10px !important; padding:0 !important">Họ và Tên đệm</label>
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthday">Ngày sinh</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" value="{{old('birthday')}}" required>
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-4">
                                <select class="form-select" name="gender" required aria-label="select example">
                                    <option value="">Chọn giới tính</option>
                                    <option value="1" @if (old('gender')=='1' ) selected="selected" @endif>nam</option>
                                    <option value="0" @if (old('gender')=='0' ) selected="selected" @endif>nữ</option>
                                </select>
                                <div class="invalid-feedback">vui lòng chọn giới tính</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mt-2">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email tại đây" value="{{old('email')}}" required>
                                <label for="email" style="top:10px !important; padding:0 !important">Email</label>
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle">Email phải đúng định dạng</i></div>
    
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mt-2">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập email tại đây" value="{{old('phone')}}" required>
                                <label for="phone"  style="top:10px !important; padding:0 !important" >Số điện thoại</label>
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle">Vui lòng nhập số điện thoại</i></div>
                            </div>
                        </div>
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="floatingTextarea2">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}"/>
                            </div>
                        </div>
                        
                           <div class="col-md-12 mt-2">
                            <div class="form-check  form-check-inline">
                                <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" value="1" @if(old('active')=='1') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault1">
                                 hoạt động
                                </label>
                           </div>
                            <div class="form-check  form-check-inline">
                                <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" value="" @if(old('active')=='') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault1">
                                 không hoạt động
                                </label>
                            </div>
                           </div>
                          
                         
                    
                    </div>
                </div>

            </div>

        </div>

        <div class="card-footer">
          <div class="row">
             <div class="col-md-8 mx-auto text-end">
               <button type="submit" class="btn btn-theme px-5"> Lưu</button>
                <a href="{{ $controller->getRedirectLink() }}" class="btn btn-secondary"> Thoát</a>
             </div>
           </div>
       </div>
    </div>
</form>


@endsection