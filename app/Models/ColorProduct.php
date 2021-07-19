<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    protected $table = "color_product";

    // n:1
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    //n:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
