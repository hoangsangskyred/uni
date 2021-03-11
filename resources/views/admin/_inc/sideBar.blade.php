<div class="logoContainer d-flex align-items-center">
    <a href="{{route('web.index')}}" class="d-block">
        <img src="/public/img/logo.png">
    </a>
</div>

<div class="flex-wrap sideMenu">
    <ul class="nav flex-column">
        <li>
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="has-dropdown">
            <a href="#about-us" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Giới thiệu</a>
            <ul class="list-unstyled collapse subMenu" id="aboutUsSubmenu">
                <li>
                    <a href="{{route('admin.about-us.index')}}">Nội dung giới thiệu</a>
                </li>
                <li>
                    <a href="{{route('admin.team-members.index')}}">Đội ngũ chuyên gia</a>
                </li>
                <li>
                    <a href="{{route('admin.image-us.index')}}">Hình ảnh trang chủ</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin.services.index')}}">Dịch vụ</a>
        </li>
        <li class="has-dropdown">
            <a href="#project" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Dự án</a>
            <ul class="list-unstyled collapse subMenu" id="projectSubmenu">
                <li>
                    <a href="{{route('admin.project-categories.index')}}">Danh mục</a>
                </li>
                <li>
                    <a href="{{route('admin.projects.index')}}">Danh sách dự án</a>
                </li>
            </ul>
        </li>
        <li class="has-dropdown">
            <a href="#blog" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Blog</a>
            <ul class="list-unstyled collapse subMenu" id="blogSubmenu">
                <li>
                    <a href="{{route('admin.article-categories.index')}}">Chủ đề</a>
                </li>
                <li>
                    <a href="{{route('admin.articles.index')}}">Bài viết</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin.settings.index')}}">Thông tin chung</a>
        </li>
        <li>
            <a href="{{route('admin.customers.index')}}">Khách Hàng</a>
        </li>
       
        @role('super-admin')
        <li>
            <a href="{{route('admin.users.index')}}">Tài khoản</a>
        </li>
        @endrole
    </ul>
</div>
