<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.services';

    public $view = 'admin.services';

    public function search(Request $request)
    {
        $list = Service::orderBy('created_at', 'desc')
            ->paginate(20);

        return $list;
    }

    public function index(Request $request)
    {
        $this->setRedirectLink($request);

        return view($this->view . '.index', ['list' => $this->search($request)])
            ->withController($this);
    }

    public function create()
    {
        $needle = new Service;

        return view($this->view . '.create', compact('needle'))
            ->withController($this);
    }

    public function validateData(Request $request)
    {
        $request->validate([
                'title' => 'required',
                'content' => 'required'
            ],[
                'title.required' => 'Vui lòng cho biết Tiêu đề',
                'content.required' => 'Vui lòng cho biết Nội dung chi tiết',
            ]
        );
    }

    public function fillDataToModel(array $validatedData, Service $service)
    {
        $service->title = $validatedData['title'];

        $service->avatar_path = $validatedData['avatarPath'];

        $service->show = $validatedData['show'] ? 'Y' : 'N';

        $service->content = $validatedData['content'];
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validateData($request);

        $needle = new Service;

        $this->fillDataToModel($request->except('_token'), $needle);
   
        $needle->save();

        if ($request->filled('saveAndCreate')) {
            return redirect()->route($this->name . '.create');
        }
        
        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function edit(Service $service)
    {
        return view($this->view . '.edit', ['needle' => $service])
            ->withController($this);
    }

    public function update(Request $request, Service $service)
    {
        $this->validateData($request);

        $this->fillDataToModel($request->except(['_token', '_method']), $service);

        $service->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->to($this->getRedirectLink())->withSuccess('Xóa dữ liệu thành công!');       
    }
}
