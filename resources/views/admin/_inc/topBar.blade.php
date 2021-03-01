<nav class="navbar navbar-expand-lg navbar-light py-0 pe-3 h-100">
    <div class="collapse navbar-collapse h-100" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{auth()->user()->name}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileResetPasswordModal" href="#">Đổi mật khẩu</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="javascript:document.getElementById('logoutForm').submit();">Thoát</a>
                        <form action="{{route('admin.logout')}}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="modal fade" id="profileResetPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileResetPasswordModalLabel">Đổi mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.profile.resetPassword')}}" method="post" novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="password" name="password" id="profilePassword" class="form-control" placeholder="Mật khẩu mới" required>
                        <label for="profilePassword">Mật khẩu mới</label>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-theme">
                            <i class="fas fa-key"></i> Đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
