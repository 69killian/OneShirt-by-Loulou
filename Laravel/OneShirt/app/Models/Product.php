<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'type', 'color', 'price', 'promotion_id', 'stock_quantity', 
    ];

    // Relation avec les catégories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    // Relation avec les images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relation avec les tailles
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    // Relation avec les avis
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relation avec les promotions
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
