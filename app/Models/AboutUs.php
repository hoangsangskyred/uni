<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about-us';

    protected $fillable = ['id','title', 'content'];
    
    protected $attributes = ['title' => null, 'content' => null];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }
}
