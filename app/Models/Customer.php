<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;
    protected $table='customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'phone',
        'address',
        'active',
    ];

    protected $dates =[
        'birthday'
    ];
    public function getFirstNameAttribute($value)
    {
        return Str::title($value);
    }
    public function getLastNameAttribute($value)
    {
        return Str::title($value);
    }
    
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    
    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday']  = Carbon::parse($value)->format('Y-m-d H:i:s');      
    }


}
