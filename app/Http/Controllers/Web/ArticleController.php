<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Service;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function detail($slug)
    {
        $needle = Article::whereSlug($slug)->whereShow('Y')->first();

        $otherArticles = Article::where('id','<>',$needle->id)->whereShow('Y')->limit(10)->get();
        
        return view('web.articles.detail', compact('needle', 'otherArticles'));
    }
}
