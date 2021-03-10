<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'articles';

    protected $fillable = [
        'id',
        'article_category_id',
        'avatar_path',
        'title',
        'avatar',
        'content',
        'show',
        'article_source_link',
    ];
    protected $attributes = [
        'article_category_id' => 1,
        'avatar_path' => null,
        'title' => null,
        'description' => null,
        'content' => null,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id')
            ->withDefault(['display_name' => '-', 'slug' => null]);
    }

    
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);

        $this->attributes['slug'] = implode('/', array_filter([$this->category->slug, Str::slug($this->attributes['title'])]));
    }
    

    public function getAvatarAttribute(): string
    {
        if ($this->attributes['avatar_path'] === null || $this->attributes['avatar_path'] == '' || !File::exists($this->attributes['avatar_path'])) {
            return '/public/img/article-default-avatar.png';
        }
        
        return $this->attributes['avatar_path'];
    }
    
    public function crawlFrom($url)
    {
        $this->attributes['article_source_link'] = $url;
    }
}
