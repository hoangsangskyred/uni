<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function resetPassword(Request $request)
    {
        $this->validate($request, ['password' => 'required'], ['password.required' => 'Vui lòng nhập mật khẩu mới']);

        $needle = auth()->user();
        $needle->password = bcrypt($request->input('password'));
        $needle->save();
        return redirect()->route('admin.dashboard')->withSuccess('Mật khẩu thay đổi thành công!');
    }
}
