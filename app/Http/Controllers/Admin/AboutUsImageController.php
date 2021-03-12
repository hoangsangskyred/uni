<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use Illuminate\Http\RedirectResponse;
use App\Models\AboutUsImage;
use App\Http\Requests\AboutUsImageRequest;

class AboutUsImageController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.image-us';

    public $view = 'admin.image-us';
    
    public function search(Request $request)
    {
        $list = AboutUsImage::orderBy('created_at','desc')
        ->paginate(10);

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
        $needle = new AboutUsImage();

        return view($this->view . '.create', compact('needle'))
            ->withController($this); 
    }

    public function store(AboutUsImageRequest $request)
    {
        $AboutUsImage = new AboutUsImage($request->all());

        $AboutUsImage->save();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');   
    }

    public function edit($id)
    {
        $aboutUsImage = AboutUsImage::find($id);

        return view($this->view . '.edit', ['needle' => $aboutUsImage])
            ->withController($this);
    }

    public function update(AboutUsImageRequest $request, $id)
    {
        AboutUsImage::where('id','<>',$id)->update(['show' => 'N']);

        $aboutUsImage = AboutUsImage::find($id);

        $aboutUsImage->update($request->all());

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');  
    }

    public function destroy($id)
    {
        $aboutUsImage = AboutUsImage::find($id);
        
        if($aboutUsImage->show == 'Y')
        {
            return redirect()->back()->withErrors('Hình ảnh đang hiển thị không thể xóa');
        }

        $aboutUsImage->delete();

        return redirect()->to($this->getRedirectLink())->withSuccess('Xóa dữ liệu thành công!');
    }
}
