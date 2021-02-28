<div class="form-floating mb-3">
    <input type="text" class="form-control text-capitalize" id="name" name="name" placeholder="Tên hiển thị" value="{{old('name', $needle->name)}}" required
           autofocus>
    <label for="name">Tên hiển thị</label>
    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
</div>

<div class="form-floating mb-3">
    <input type="text" class="form-control" id="email" name="email" placeholder="E-mail đăng nhập" value="{{old('email', $needle->email)}}" required
           autofocus>
    <label for="email">E-mail đăng nhập</label>
    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
</div>

<div class="form-floating mb-3">
    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value=""
           autofocus>
    <label for="email">Mật khẩu</label>
    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
</div>

<div class="form-group">
    @foreach($roles as $role)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="role[]" value="{{$role->id}}" id="role{{$role->name}}" {{$needle->hasRole($role->id)?'checked':''}}>
            <label class="form-check-label" for="role{{$role->name}}">
                {{$role->display_name}}
            </label>
        </div>
    @endforeach
</div>
