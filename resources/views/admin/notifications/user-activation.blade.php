<p>Thân chào {{$data['full_name']}},</p>
<p>Vui lòng bấm vào link bên dưới để kịch hoạt tài khoản tại website {{str_replace(['http://','https://', '', env('APP_URL')])}}</p>
<p><a href="#">{{route('users.verify')}}</a></p>
<p>Nếu bấm vào liên kết không có tác dụng, vui lòng sao chép toàn bộ đường dẫn trên vào cửa sổ trình duyệt.</p>
<p>Trân trọng.
    <br>Ban Quản Trị</p>
