<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $needle = AboutUs::first();

        $teamMembers = TeamMember::whereShow('Y')->get();

        return view('web.about-us', compact('needle', 'teamMembers'));
        
    }
}
