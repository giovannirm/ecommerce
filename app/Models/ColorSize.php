<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    use HasFactory;

    protected $table = "color_size";

    // n:1
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    // n:1
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
