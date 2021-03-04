<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Article;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamMemberController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.team-members';

    public $view = 'admin.team-members';

    public function search(Request $request)
    {
        $list = TeamMember::orderBy('created_at','desc')
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
                'fullName' => 'required',
                'title' => 'required',
            ],[
                'fullName.required' => 'Vui lòng cho biết Họ tên',
                'title.required' => 'Vui lòng cho biết Nghề nghiệp/Chức vụ',
            ]
        );
    }

    public function fillDataToModel(array $validatedData, TeamMember $teamMember)
     {
        $teamMember->full_name  = $validatedData['fullName'];

        $teamMember->title      = $validatedData['title'];

        if ($validatedData['avatarPath'] != '')
            $teamMember->avatar_path = $validatedData['avatarPath'];

        $teamMember->show       = $validatedData['show'] ? 'Y' : 'N';
    }

    public function store(Request $request): RedirectResponse
    {  
        $this->validateData($request);

        $needle = new TeamMember;

        $this->fillDataToModel($request->except('_token'), $needle);
        
        $needle->save();

        if ($request->filled('saveAndCreate')) {
            
            return redirect()->route($this->name . '.create');

        }

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');
    }

    public function edit(TeamMember $teamMember)
    {
        return view($this->view . '.edit', ['needle' => $teamMember])
            ->withController($this);
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $this->validateData($request);

        $this->fillDataToModel($request->except(['_token', '_method']), $teamMember);
        
        $teamMember->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function destroy(TeamMember $article)
    {
        $article->delete();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Xóa dữ liệu thành công!');
    }
}
