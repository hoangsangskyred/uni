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

    public function validateData(Request $request, $except_id = null)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email' . ($request->method()=='PUT'||$request->method()=='PATCH'?(','.$except_id):''),
            'role' => 'required'
        ];

        $request->validate($rules, [
            'name.required' => 'Vui lòng cho biết tên gọi',
            'email.required' => 'Vui lòng cho biết email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được đăng ký. Vui lòng chọn email khác.',
            'role.required' => 'Vui lòng chọn vai trò của tài khoản này.',
        ]);
    }

    public function fillDataToModel(array $validatedData, User $user)
    {
        $user->name = Str::title($validatedData['name']);

        $user->email = $validatedData['email'];

        if (!is_null($validatedData['password']))
            $user->password = bcrypt($validatedData['password']);

    }

    public function store(Request $request): RedirectResponse
    {
        $this->validateData($request);

        $data = $request->except('_token');

        $needle = new User();

        //$needle->confirm_code = Str::random(64);
        $this->fillDataToModel($data, $needle);

        if ($needle->save()) {
            $needle->roles()->sync($data['role']);

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

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validateData($request, $id);

        $data = $request->except('_token', '_method');

        $needle = User::find($id);

        $this->fillDataToModel($data, $needle);

        if ($needle->save()) {

            $needle->roles()->sync($data['role']);

            return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');

        } else {
            
            return redirect()->back()->withErrors(['Lỗi không xác định! Vui lòng liên lạc với Quản trị viên']);
        }
    }

}
