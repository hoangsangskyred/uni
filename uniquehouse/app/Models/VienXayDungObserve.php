<?php

namespace App\Models;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class VienXayDungObserve
{
    public $article;
    private $url;

    public function __construct(string $url, Article $article = null)
    {
        $this->article = $article ? $article : new Article;
        $this->url = $url;
    }

    public function scrape()
    {
        $client = new Client();
        $crawler = $client->request('GET', $this->url);
        $crawledContent = $crawler->filter('main#genesis-content')->filter('article');
        $this->article->title = $crawledContent->filter('h1.entry-title')->text();
        $this->article->content = $crawledContent->filter('div.entry-content')->html();
    }
}
