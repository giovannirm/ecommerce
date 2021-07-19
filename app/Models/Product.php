<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //accesores
    public function getStockAttribute()
    {
        if ($this->subcategory->size) {
            return  ColorSize::whereHas('size.product', function (Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        } elseif ($this->subcategory->color) {
            return  ColorProduct::whereHas('product', function (Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        } else {
            return $this->quantity;
        }
    }

    // 1:n
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
    
    // n:1
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // n:1
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // n:m
    public function colors()
    {
        return $this->belongsToMany(Color::class)->withPivot('quantity');
    }    

    // 1:n polimórfica
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
