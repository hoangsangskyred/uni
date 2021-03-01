<div class="form-floating mb-3">
    <input type="text" class="form-control text-capitalize" id="displayName" name="displayName" placeholder="Tên hiển thị" value="{{old('displayName', $needle->display_name)}}" required autofocus>
    <label for="displayName">Tên hiển thị</label>
    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i>  Không được rỗng</div>
</div>
