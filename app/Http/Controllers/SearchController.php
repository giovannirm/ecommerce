<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class SearchController extends Controller
{
    use WithPagination;

    public function __invoke(Request $request)
    {
        $name = $request->name;

        $products = Product::where('name', 'like', '%' . $name . '%')
                                ->where('status', 2)
                                ->paginate(8);

        return view('search', compact('products'));   
    }
}
