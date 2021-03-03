<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.about-us';
    public $view = 'admin.about-us';

    public function index()
    {
        $needle = AboutUs::first();
        
        if ( $needle ) {

            return redirect()->route( $this->name . '.edit', [$needle] );

        } else {

            return redirect()->route($this->name . '.create');
        }

    }

    public function create()
    {
        
        $needle = new AboutUs();
        
        return view($this->view . '.create', [ 'needle' => $needle ] )
            ->with(['controller' => $this]);

    }

    public function fillDataToModel( array $validatedData, AboutUs $aboutUs )
    {
        
        $aboutUs->title = $validatedData['title'];

        $aboutUs->content = $validatedData['content'];

    }

    public function store( Request $request )
    {
        
        $request->validate(['title' => 'required', 'content' => 'required'],
            [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'content.required' => 'Vui lòng cung cấp nội dung chi tiết'
            ]);

        $needle = new AboutUs();

        $this->fillDataToModel($request->except('_token'), $needle);

        if ($needle->save()) {

            return redirect()->route($this->name . '.edit', [$needle]);

        } else {

            return redirect()->back()->withErrors(['Lỗi không xác định! Vui lòng báo với Quản trị viên']);

        }
    }

    public function edit($id)
    {
        
        $needle = AboutUs::find($id);

        return view($this->view . '.edit', ['needle' => $needle])
            ->with(['controller' => $this]);

    }

    public function update(Request $request, $id)
    {

        $needle = AboutUs::find( $id);

        if ($needle) {

            $this->fillDataToModel($request->except(['_token', '_method']), $needle);

            $needle->save();

            return redirect()->route($this->name . '.edit', [$needle])->withSuccess('Lưu dữ liệu thành công!');

        } else {

            return redirect()->back()->withErrors(['Lỗi không xác định! Vui lòng báo với Quản trị viên']);

        }
    }
}
