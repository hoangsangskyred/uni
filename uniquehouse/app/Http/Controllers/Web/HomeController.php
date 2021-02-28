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
       // $user= User::find(1)->update(['email'=>'hoangsangskyred@gmail.com','password'=>bcrypt(123456)]);
        //dd($user);
        $teamMembers = TeamMember::whereShow('Y')->get();
        return view('web.welcome', compact('teamMembers'));
    }
}
