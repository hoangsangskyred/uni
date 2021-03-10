<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.users';

    public $view = 'admin.users';

    public function index()
    {
        $list = User::whereNotIn('name', ['super-admin'])->where( 'id' , '<>',auth()->id())->orderBy('name')->get();

        return view($this->view . '.index', compact('list'))->withController($this);     
    }

    public function create()
    {
        if (auth()->user()->hasRole('super-admin'))
            $roles = Role::whereNotIn('name', ['super-admin'])->orderBy('priority')->get();
        else
            $roles = Role::whereNotIn('name', ['super-admin','admin'])->orderBy('priority')->get();

        $needle = new User();

        return view($this->view . '.create', compact('needle', 'roles'))->withController($this);
    }

    public function store(UserRequest $request)
    {
        $user = new User($request->all());
       
        $data = $request->except('_token');

        if($user->save()) {
            $user->roles()->sync($data['role']);
            
            return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');   
        } else {
            return redirect()->back()->withErrors(['Lỗi không xác định! Vui lòng liên lạc với Quản trị viên']);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->hasRole('super-admin'))
            $roles = Role::whereNotIn('name', ['super-admin'])->orderBy('priority')->get();
        else
            $roles = Role::whereNotIn('name', ['super-admin','admin'])->orderBy('priority')->get();

        $needle = User::find($id);

        return view($this->view . '.edit', compact('needle','roles'))
            ->withController($this);
    }

    public function update(UserRequest $request,User $user)
    {
        $data = $request->except('_token', '_method');

        if($user->update($request->all()))
        {
            $user->roles()->sync($data['role']);

            return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
        }
        else {
            return redirect()->back()->withErrors(['Lỗi không xác định! Vui lòng liên lạc với Quản trị viên']);
        }

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->to($this->getRedirectLink())->withSuccess('Xóa dữ liệu thành công!');
    }

}
