<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AboutUsImage extends Model
{
    use HasFactory;
    protected $table = 'about-us-image';

    protected $fillable = ['id','title', 'image_path','description','show'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }
}
