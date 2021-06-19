<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // 1:n
    public function products()    
    {
        return $this->hasMany(Product::class);
    }

    // n:1
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
