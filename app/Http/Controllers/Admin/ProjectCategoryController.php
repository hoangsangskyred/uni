<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectCategoryRequest;

class ProjectCategoryController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.project-categories';

    public $view = 'admin.project-categories';


    public function search(Request $request)
    {
        $list = ProjectCategory::withCount('projects')
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
    public function store(ProjectCategoryRequest $request)
    {
        $ProjectCategory = new ProjectCategory($request->all());

        $ProjectCategory->save();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');
    }

    public function edit(ProjectCategory $ProjectCategory)
    {
        return view($this->view . '.edit', ['needle' => $ProjectCategory])
            ->withController($this);
    }

    public function update(ProjectCategoryRequest $request, ProjectCategory $ProjectCategory)
    {
        $ProjectCategory->update($request->all());

        $ProjectCategory->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
        
    }

    public function destroy(ProjectCategory $ProjectCategory)
    {
        $ProjectCategory->projects()->delete();
        
        $ProjectCategory->delete();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Xóa dữ liệu thành công!');
    }
}
