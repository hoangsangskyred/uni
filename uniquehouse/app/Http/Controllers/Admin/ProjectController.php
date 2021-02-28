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

    public function validateData(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ],[
                'title.required' => 'Vui lòng cho biết Tên hiển thị',
                'content.required' => 'Vui lòng cho biết Nội dung bài viết',
            ]
        );
    }

    public function fillDataToModel(array $validatedData, Project $project) {
        $project->title     = $validatedData['title'];
        $project->project_category_id = intval($validatedData['category']);
        $project->avatar_path = $validatedData['avatarPath'];
        $folder = pathinfo($project->avatar_path);
        $project->folder_path = $folder['dirname'];
        $images = File::files(public_path(str_replace('/public','',$project->folder_path)));
        $project->photo_count = intval(count($images));
        $project->show      = $validatedData['show'] ? 'Y' : 'N';
        $project->content   = $validatedData['content'];
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validateData($request);
        $needle = new Project;
        $this->fillDataToModel($request->except('_token'), $needle);
        //dd($needle);
        $needle->save();

        if ($request->filled('saveAndCreate')) {
            return redirect()->route($this->name . '.create');
        }

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');
    }

    public function edit(Project $project)
    {
        return view($this->view . '.edit', ['needle' => $project])
            ->withController($this);
    }

    public function update(Request $request, Project $project)
    {
        $this->validateData($request);

        $this->fillDataToModel($request->except(['_token', '_method']), $project);
        $project->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function destroy(Project $article)
    {
        $article->delete();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Xóa dữ liệu thành công!');
    }
}
