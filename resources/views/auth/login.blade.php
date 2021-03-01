@extends('layouts.plain')
@push('page-title', 'Đăng nhập')
@section('page-content')
    <div class="banner-slider-container d-flex align-items-center" style="background-image: url('/public/img/login-bg_2.jpg'); background-position: center center; background-size: cover;height: 700px;">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Đăng nhập</h5>
                        </div>
                        <div class="card-body">
                            @include('layouts.inc.alerts')

                            <form action="{{url('auth/login')}}" method="post" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="name@example.com" required autofocus>
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i>  Không được rỗng</div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                                    <label for="password">Mật khẩu</label>
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i>  Không được rỗng</div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                                        <label class="form-check-label" for="remember">
                                            Ghi nhớ mật khẩu
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-theme w-100 mb-3">
                                        OK
                                    </button>
                                    <a href="#">Quên mật khẩu?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
