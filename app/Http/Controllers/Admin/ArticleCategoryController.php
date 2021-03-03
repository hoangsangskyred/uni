<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.article-categories';

    public $view = 'admin.article-categories';

    public function search(Request $request)
    {
        
        $list = ArticleCategory::withCount('articles')
            ->orderBy('display_name','asc')
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

        return view($this->view . '.create')->withController($this);

    }

    public function validateData(Request $request)
    {
       
        $request->validate(
            ['displayName' => 'required'],
            ['displayName.required' => 'Vui lòng cho biết Tên hiển thị']
        );

    }

    public function store(Request $request)
    {
       
        $this->validateData($request);

        $needle = ArticleCategory::create(['display_name' => $request->input('displayName')]);

        if ($request->filled('create')) {

            return redirect()->route($this->name . '.create');

        }

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');
    }

    public function edit(ArticleCategory $articleCategory)
    {

        return view($this->view . '.edit', ['needle' => $articleCategory])
            ->withController($this);

    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {

        $this->validateData($request);

        $articleCategory->display_name = $request->input('displayName');

        $articleCategory->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function destroy(ArticleCategory $articleCategory)
    {

        $articleCategory->articles()->delete();

        $articleCategory->delete();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Xóa dữ liệu thành công!');
    }
    
}
