<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category, $filter_subcategory, $filter_brand;

    public $view = 'grid';

    public function clean()
    {
        $this->reset(['filter_subcategory', 'filter_brand']);
    }
    
    public function render()
    {
        /* $products = $this->category->products()
                            ->where('status', 2)
                            ->paginate(20); */

        $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
            $query->where('id', $this->category->id);
        });

        if($this->filter_subcategory)
        {
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('name', $this->filter_subcategory);
            });
        }

        if($this->filter_brand)
        {
            $productsQuery = $productsQuery->whereHas('brand', function(Builder $query){
                $query->where('name', $this->filter_brand);
            });
        }

        $products = $productsQuery->paginate(20);

        return view('livewire.category-filter', compact('products'));
    }
}
