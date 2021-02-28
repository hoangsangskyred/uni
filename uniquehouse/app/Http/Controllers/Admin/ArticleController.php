<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectAfterSubmit;
use App\Models\Article;
use App\Models\ArticleCrawlObserve;
use App\Models\ArticleSourceLink;
use Illuminate\Http\Request;
use Spatie\Crawler\Crawler;

class ArticleController extends Controller
{
    use RedirectAfterSubmit;

    public $name = 'admin.articles';
    public $view = 'admin.articles';

    public function search(Request $request)
    {
        $list = Article::with('category')
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

    public function fillDataToModel(array $validatedData, Article $article) {
        $article->title     = $validatedData['title'];
        $article->article_category_id = intval($validatedData['category']);
        $article->avatar_path = $validatedData['avatarPath'];
        $article->show      = $validatedData['show'] ? 'Y' : 'N';
        $article->content   = $validatedData['content'];
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $needle = $this->fillDataToModel($request, new Article);
        $needle->save();

        if ($request->filled('saveAndCreate')) {
            return redirect()->route($this->name . '.create');
        }

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Lưu dữ liệu thành công!');
    }

    public function edit(Article $article)
    {
        return view($this->view . '.edit', ['needle' => $article])
            ->withController($this);
    }

    public function update(Request $request, Article $article)
    {
        $this->validateData($request);

        $this->fillDataToModel($request->except(['_token', '_method']), $article);
        $article->save();

        return redirect()->to($this->getRedirectLink())->withSuccess('Lưu dữ liệu thành công!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->to( $this->getRedirectLink() )->withSuccess('Xóa dữ liệu thành công!');
    }
}
