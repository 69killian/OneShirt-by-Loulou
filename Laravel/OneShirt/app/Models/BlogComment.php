<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id', 'user_id', 'comment', 'article_slug'
    ];

    public function article()
    {
        return $this->belongsTo(BlogArticle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

