<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // 1:n
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    // n:m
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }    
}
