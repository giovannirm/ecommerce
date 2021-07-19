<?php

namespace App\Http\Livewire;

use App\Models\ColorSize;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AddCartItemSize extends Component
{
    public $product, $sizes;

    public $color_id = "";

    public $qty = 1;
    public $quantity = 0;
    /* public $quantity_size = 0; */

    public $size_id = "";

    public $colors = [];

    public $options = [];

    public function updatedSizeId($value)
    {
        $size = Size::find($value);
        $this->colors = $size->colors;

        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;

        /* $this->quantity_size = ColorSize::whereHas('size.product', function (Builder $query){
                            $query->where('id', $this->product->id)->where('size_id', $this->size_id);
                            })->sum('quantity'); */

        $this->reset('quantity', 'color_id');
    }

    public function updatedColorId($value)
    {
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        /* $this->quantity = $color->pivot->quantity; */
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
    }

    public function mount()
    {
        $this->sizes = $this->product->sizes;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function decrement()
    {
        $this->qty--;
    }

    public function increment()
    {
        $this->qty++;
    }

    public function addItem()
    {
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'weight' => 550,
            'options' => $this->options
        ]);

        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);

        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
