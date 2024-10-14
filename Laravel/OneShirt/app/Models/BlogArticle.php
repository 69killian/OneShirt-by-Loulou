<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 
use App\Models\BlogComment; 

class BlogArticle extends Model
{
    use HasFactory;

    protected $table = 'blog_articles';

    protected $fillable = [
        'title', 'slug', 'content', 'image', 'author_id'
    ];

  
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

  
    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
}


