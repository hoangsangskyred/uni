<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Article;
use App\Models\ArticleCrawlObserve;
use App\Models\ArticleSourceLink;
use Illuminate\Http\Request;
use Spatie\Crawler\Crawler;
use App\Models\ArticleCategory;
use DB;
use Illuminate\Support\Str;
use App\Http\Requests\ArticleRequest;
class ArticleController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.articles';

    public $view = 'admin.articles';

    public function search(Request $request)
    {      
        $search = $request->get('q');

        $list = Article::with('category');
    
        $list->when( request('q') !== null, function ($query) {
            $query->where(function ($query){
                $query->where('title', 'LIKE', '%' . request('q') . '%');
             });            
         })->when( request('display_name') !== null, function ($query) {
             $query->where('article_category_id', request('display_name'));
         });

        $list = $list->latest()->paginate(5)->withQueryString() ;   

        return $list;
    }

    public function index(Request $request)
    {
        $articleCategories = ArticleCategory::all();
        
        $this->setRedirectLink($request);
       
        return view($this->view . '.index', ['list' => $this->search($request),'articleCategories'=> $articleCategories])
        ->withController($this); 
    }

    public function create()
    {
        $needle = session('importedArticle', new Article);

        return view($this->view . '.create', compact('needle'))
            ->withController($this);
    }

    public function showCrawlForm()
    {
        return view($this->view . '.crawl')->withController($this);
    }

    public function crawl(Request $request)
    {
        $source = new ArticleSourceLink($request->input('sourceLink'));

        $source->article->article_category_id = $request->input('category');

        $source->observer->scrape();

        if ($source->observer) {
            $source->article->save();

            return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
        } else {
            return redirect()->to($this->getRedirectLink())->withErrors(['Lỗi! Không thể truy xuất website đã cung cấp.']);
        }
    }

    public function store(ArticleRequest $request)
    {
        $article = new Article( $request->all() );
        
        $article->save();
       
        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');  
    }
  
    public function edit(Article $article)
    {
        return view($this->view . '.edit', ['needle' => $article])
            ->withController($this);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());
        
        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Xóa dữ liệu thành công!');
    }
}
