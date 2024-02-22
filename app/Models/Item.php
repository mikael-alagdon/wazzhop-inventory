<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Item extends Model
{
    
    protected $guarded = [];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
