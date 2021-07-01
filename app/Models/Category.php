<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'icon'];

    // 1:n
    public function subcategories()
    {           
        return $this->hasMany(Subcategory::class);
    }

    // n:m
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    // 1:n a través de subcategories
    public function products()
    {
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }

    // URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
