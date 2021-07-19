<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <x-cart color="white" size="30"/>
                
                @if (Cart::Count())
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
                @else
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                @endif
                
            </span>           
        </x-slot>

        <x-slot name="content">

            <ul class="max-h-96 overflow-y-auto">
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4 rounded-lg" src="{{ $item->options->image }}" alt="">

                        <article class="flex-1">    
                            <h1 class="font-bold">{{ $item->name }}</h1>

                            <div class="flex">
                                <p>{{ __('Quantity') . ': ' . $item->qty}}</p>
                                 
                                {{-- Si el parámetro color está definido se muestra --}}
                                @isset($item->options['color'])
                                    <p class="mx-1">{{ '- ' . __('Color') . ': ' . $item->options->color }}</p>
                                @endisset                
                                
                                @isset($item->options['size'])
                                    <p>{{ $item->options->size }}</p>
                                @endisset
                            </div>                            

                            <p>{{ __('Coin') . ': ' . $item->price}}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            {{ __('Dropdown Shopping Cart') }}
                        </p>
                    </li>
                @endforelse
            </ul>

            {{-- Si existen items en el carrito de compras --}}
            @if (Cart::count())                
                <div class="py-2 px-3">
                    <p class="text-lg text-gray-700 mt-2 mb-3">
                        <span class="font-bold">{{ __('Total') . ': '}}</span>
                        {{ __('Coin') . Cart::subtotal()}}
                    </p>

                    <x-button-link href="{{ route('shopping-cart') }}" color="orange" class="w-full">
                        {{ __('Go Shopping Cart') }}
                    </x-button-link>
                </div>                
            @endif
        </x-slot>
    </x-jet-dropdown>
</div>