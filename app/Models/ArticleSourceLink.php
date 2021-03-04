<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArticleSourceLink extends Model
{
    use HasFactory;

    public $url;
    public $article;
    private $protocol;
    private $content;
    private $website_address;

    public function __construct($url = null, Article $article = null)
    {
        if ($url)
        {
            $this->url = $url;

            $this->protocol = Str::startsWith($this->url,'https://') ? 'https://' : 'http://';

            $content_parts = explode('/', str_replace($this->protocol, '', $this->url));

            $this->website_address = Str::startsWith($content_parts[0],'www.')?$content_parts[0]:('www.'.$content_parts[0]);
        }
        
        $this->article = $article ? $article : new Article;
    }

    public function getObserverAttribute()
    {
        if ($this->website_address == 'www.vienxaydung.edu.vn') {
            return new VienXayDungObserve($this->url, $this->article);
        }
        return null;
    }

}
