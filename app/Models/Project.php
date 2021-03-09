<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'project_category_id',
        'avatar_path',
        'title',
        'content',
        'show'
    ];
    protected $attributes = [
        'project_category_id' => 1,
        'avatar_path' => null,
        'title' => null,
        'content' => null,
        'show' => 'Y'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id')
            ->withDefault(['display_name' => '-', 'slug' => null]);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
        $this->attributes['slug'] = implode('/', [$this->category->null, Str::slug($this->attributes['title'])]);
    }
}
