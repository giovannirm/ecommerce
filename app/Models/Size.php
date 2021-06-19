<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'products_id'];

    // n:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // n:m
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
}
