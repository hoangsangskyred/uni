<div class="form-floating mb-3">
    <input type="text" class="form-control text-capitalize" id="display_name" name="display_name" placeholder="Tên hiển thị" value="{{old('display_name', $needle->display_name)}}" required autofocus>
    <label for="display_name">Tên hiển thị</label>
    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i>  Không được rỗng</div>
</div>
