<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function all()
    {
        $list = Service::whereShow('Y')->get();

        return view('web.services.all', compact('list'));
    }

    public function show($slug, $service_prefix)
    {
        $needle = Service::whereSlug($slug)->whereShow('Y')->first();
        $otherServices = Service::where('id','<>',$needle->id)->whereShow('Y')->get();
        return view('web.services.detail', compact('needle', 'otherServices'));
    }

}
