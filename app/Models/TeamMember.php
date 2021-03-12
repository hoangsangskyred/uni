<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_members';
    protected $fillable = [
        'full_name','avatar_path','title', 'phone', 'facebook', 'twitter', 'linkedin', 'show'
    ];
    protected $attributes = [
        'full_name' => null, 'avatar_path' => '/public/img/default-avatar.jpg',
        'title' => null, 'phone' => null, 'facebook' => null, 'twitter' => null, 'linkedin' => null, 'show' => 'N'
    ];

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = Str::title($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    public function hasAvatar(): bool
    {
        return $this->attributes['avatar_path'] !== null;
    }
}
