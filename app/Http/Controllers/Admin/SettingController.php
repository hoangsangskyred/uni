<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.settings';

    public $view = 'admin.settings';


    public function index()
    {
        $list = Setting::orderBy('name','asc')->get();

        return view($this->view . '.index', compact('list'))->withController($this);
    }

    public function edit($id)
    {     
        $needle = Setting::find($id);

        return view($this->view . '.edit', compact('needle'))->withController($this);
    }

    public function update(Request $request, $id)
    {
        $needle = Setting::find($id);

        if ($needle) {
            $needle->display_name = $request->input('display_name');

            $needle->setting_value = $request->input('setting_value');

            $needle->save();

            return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
        } else {
            return redirect()->back()->withErrors(['Không tìm thấy mẫu tin!']);         
        }
    }
}
