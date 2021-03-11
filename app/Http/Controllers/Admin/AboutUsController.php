<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Requests\AboutUsRequest;

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

    public function store(AboutUsRequest $request )
    {
        $aboutUs = new AboutUs(request()->all());
        
        $aboutUs->save();
       
        return redirect()->route($this->name . '.edit')->withSuccess('Lưu dữ liệu thành công!'); 
    }

    public function edit($id)
    {
        $needle = AboutUs::find($id);

        return view($this->view . '.edit', ['needle' => $needle])
            ->with(['controller' => $this]);
    }

    public function update(AboutUsRequest $request, $id)
    {
        $aboutUs = AboutUs::find($id);

        $aboutUs->update($request->all());
        
        return redirect()->back()->with('success','Lưu dữ liệu thành công!');    
    }
}
