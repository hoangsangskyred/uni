<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
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

    public function store(ServiceRequest $request)
    {
        $service = new Service( $request->all() );
        
        $service->save();
       
        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!'); 
    }

    public function edit(Service $service)
    {
        return view($this->view . '.edit', ['needle' => $service])
            ->withController($this);         
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        
        $service->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->to($this->getRedirectLink())->withSuccess('Xóa dữ liệu thành công!');
    }
}
