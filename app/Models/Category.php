<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Category extends Model
{
    
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
