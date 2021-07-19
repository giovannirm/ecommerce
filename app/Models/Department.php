<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // 1:n
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    // 1:n
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
