<div>
    <a href="{{ route('shopping-cart') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
        <span class="flex justify-center w-9">
            <i class="fas fa-shopping-cart"></i>
        </span>
        <span class="flex">
            <span class="mr-2">{{ __('Shopping Cart') }}</span>  
            
            @if (Cart::Count())     
                <span class="px-2 py-1 text-xs font-bold text-red-100 bg-red-600 rounded-full">{{ Cart::count() }}</span>
            @else
                <span class="inline-block w-2 h-2 mr-2 bg-red-600 rounded-full"></span>
            @endif
        </span>        
    </a>
</div>
