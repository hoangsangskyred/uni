<nav class="navbar navbar-expand-lg navbar-default">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('web.index')}}">
            <img src="/public/img/logo_185x60.png">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.index')}}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.aboutUs')}}">Giới thiệu</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('web.services')}}" id="navbarServices" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dịch vụ
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarServices">
                        @foreach(\App\Models\Service::whereShow('Y')->get() as $service)
                        <li><a class="dropdown-item" href="{{route('web.service.detail', [$service->slug, 'dich-vu'])}}">{{$service->title}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarProjects" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dự án
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarProjects">
                        <li><a class="dropdown-item" href="#">Biệt thự</a></li>
                        <li><a class="dropdown-item" href="#">Căn hộ</a></li>
                        <li><a class="dropdown-item" href="#">Nhà phố</a></li>
                        <li><a class="dropdown-item" href="#">Văn hòng</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
