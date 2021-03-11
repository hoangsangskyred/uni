<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Article;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\TeamMemberRequest;

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
        $needle = new TeamMember();

        return view($this->view . '.create', compact('needle'))
            ->withController($this); 
    }

    public function store(TeamMemberRequest $request)
    {  
        $teamMember = new TeamMember($request->all());

        $teamMember->save();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');   
    }

    public function edit(TeamMember $teamMember)
    {
        return view($this->view . '.edit', ['needle' => $teamMember])
            ->withController($this);
    }

    public function update(TeamMemberRequest $request, TeamMember $teamMember)
    {
        $teamMember->update($request->all());

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');   
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->to($this->getRedirectLink())->withSuccess('Xóa dữ liệu thành công!');
    }
}
