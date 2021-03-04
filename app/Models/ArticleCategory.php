<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ArticleCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'article_categories';

    protected $fillable = ['display_name'];

    protected $attributes = ['display_name' => null, 'slug' => null, 'show' => 'Y'];

    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = Str::title($value);
        
        $this->attributes['slug'] = Str::slug($this->attributes['display_name']);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }
}
