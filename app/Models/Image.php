<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'iamgeable_id', 'imageable_type'];

    // n:1 polimórfica
    public function imageable()
    {
        return $this->morphTo();
    }
}
