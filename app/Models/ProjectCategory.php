<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $table = 'project_categories';
    protected $fillable = ['display_name'];
    protected $attributes = ['display_name' => null, 'slug' => null, 'show' => 'Y'];

    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = Str::title($value);
        $this->attributes['slug'] = Str::slug($this->attributes['display_name']);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'project_category_id');
    }
}
