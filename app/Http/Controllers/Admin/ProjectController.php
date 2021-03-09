<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Article;
use App\Models\ArticleSourceLink;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.projects';

    public $view = 'admin.projects';

    public function search(Request $request)
    {
        $list = Project::with('category')
            ->orderBy('created_at','desc')
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
        $needle = session('importedArticle', new Article);

        return view($this->view . '.create', compact('needle'))
            ->withController($this);
    }
    public function store(ProjectRequest $request)
    {
        $project = new Project($request->all());

        $project->save();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');    
    }

    public function edit(Project $project)
    {
        return view($this->view . '.edit', ['needle' => $project])
            ->withController($this);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());

        $project->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');   
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Xóa dữ liệu thành công!');
    }
}
