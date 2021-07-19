<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="{{ __('Contact Name') }}"/>
                <x-jet-input type="text"
                            placeholder="{{ __('Placeholder Contact Name') }}"
                            class="w-full"/>
            </div>

            <div>
                <x-jet-label value="{{ __('Contact Phone') }}"/>
                <x-jet-input type="text"
                            placeholder="{{ __('Placeholder Contact Phone') }}"
                            class="w-full"/>
            </div>
        </div>

        <div>
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">{{ __('Shipments') }}</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input type="radio" name="shipment" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    {{ __('Pick On Store') . ' (Calle falsa 123)' }}
                </span>

                <span class="font-semibold text-gray-700 ml-auto">
                    {{ __('Free') }}
                </span>
            </label>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center">
                <input type="radio" name="shipment" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    {{ __('Home Delivery') }}
                </span>
            </label>
        </div>

        <div>
            <x-jet-button class="mt-6 mb-4">
                {{ __('Continue With the Buy') }}
            </x-jet-button>

            <hr>

            <p class="text-sm text-gray-700 mt-2">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum sunt libero hic ipsam nisi! Odit vel porro assumenda explicabo laudantium autem, ducimus hic architecto voluptates iste deserunt pariatur nisi nostrum!
                <a href="" class="font-semibold text-orange-500">{{ __('Privacy Policy') }}</a>
            </p>
        </div>
    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
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

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    {{ __('Subtotal') }}
                    <span class="font-semibold">{{ __('Coin') . ' ' . Cart::subtotal() }}</span>
                </p>
                <p class="flex justify-between items-center">
                    {{ __('Shipment') }}
                    <span class="font-semibold">{{ __('Free') }}</span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">                    
                    <span class="text-lg">{{ __('Total') }}</span>
                    {{ __('Coin') . ' ' . Cart::subtotal() }}
                </p>
            </div>
        </div>        
    </div>
</div>
