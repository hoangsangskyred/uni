<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
class ProfileController extends Controller
{
    public function resetPassword(ProfileRequest $request)
    {
        $needle = auth()->user();

        $needle->update($request->all());

        return redirect()->route('admin.dashboard')->withSuccess('Mật khẩu thay đổi thành công!');
    }
}
