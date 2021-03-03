<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends Controller
{
    public function index()
    {
       $teamMembers = TeamMember::whereShow('Y')->get();
       
       return view('web.welcome', compact('teamMembers'));
    }
}
