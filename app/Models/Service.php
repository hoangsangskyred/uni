<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'avatar_path',
        'title',
        'description',
        'content',
        'show'
    ];
    protected $attributes = [
        'avatar_path' => null,
        'title' => null,
        'description' => null,
        'content' => null,
        'show' => 'Y' ?'Y':'N'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
        
        $this->attributes['slug'] = Str::slug($this->attributes['title']);
    }
}
