<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Category extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
