<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // n:m
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // n:m
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
}
