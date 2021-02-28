@extends('layouts.admin')

@push('page-title', 'Cập nhật thông tin khách hàng')
@section('page-content')
<h1>@stack('page-title')</h1>

<form id="createForm" action="{{ route($name.'.update', $customer->id) }}" method="post" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h5>Chỉnh sửa khách hàng</h5>
            </div>
            <div class="card-body">
                @include('layouts.inc.alerts')
                <div class="row">
                   <div class="col-md-8 mx-auto">
                       <div class="row">
                            <div class="col-md-6">
                               <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-capitalize" id="firstname" name="first_name" placeholder="First Name" value="{{ $customer->first_name }}" required autofocus>
                                        <label for="first_name">Fisrt Name</label>
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                               <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-capitalize" id="last_name" name="last_name" placeholder="Last Name" value="{{ $customer->last_name }}" required autofocus>
                                        <label for="last_name">Last Name</label>
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                  <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input type="text" class="form-control" id="birthday" name="birthday" value="{{$customer->birthday->format('d-m-Y')}}" required>
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                                  </div>
                               </div>
                              <div class="col-md-6">
                                  <div class="gender">
                                        <label for="gender">Giới Tính</label>
                                        <select class="form-select" required aria-label="select example" name="gender">
                                        <option value="{{$customer->gender=='male' ? 'male' :'female'}}">{{$customer->gender=="male" ? "male" :"female"}}</option>
                                        <option value="{{$customer->gender=='female' ? 'male' :'female'}}">{{$customer->gender=="female" ? "male" :"female"}}</option>
                                        </select>
                                   <div class="invalid-feedback">vui lòng chọn giới tính</div>
                                </div>
                              </div>
                               
                              <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email tại đây" value="{{$customer->email}}" required>
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle">Email phải đúng định dạng</i></div>
                              </div>
                              <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$customer->phone}}" >
                               </div>
                               <div class="form-group">
                                     <label for="floatingTextarea2">Address</label>
                                     <textarea class="form-control"  name="address" id="address" style="height: 60px" >{{$customer->address }}</textarea>
                                </div>
                               
                                <div class="form-floating mb-3">
                                     <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" name="status" id="showCheck" value="1" {{ (old() ? old('active', false) : $customer->active ?? false) ? 'checked' : '' }} >
                                      <label class="form-check-label" for="showCheck">Active</label>
                                  </div>
                                  
                             </div>
                         </div>
                    </div>
                
                </div>
            </div>
            
             <div class="card-footer">
                <div class="row">
                    <div class="col-md-8 mx-auto text-end">
                        <button type="submit" class="btn btn-theme px-5">
                            Lưu
                        </button>
                        <a href="{{route($name.'.index')}}" class="btn btn-secondary">
                            Thoát
                        </a>
                    </div>
                </div>
             </div>
        </div>
    </form>

@endsection