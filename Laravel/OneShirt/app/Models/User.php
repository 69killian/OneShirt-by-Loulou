<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password_hash', 
        'phone_number', 'date_of_birth', 'address', 'postal_address', 
        'profile_picture', 'role'
    ];

    public function blogArticles()
    {
        return $this->hasMany(BlogArticle::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}

