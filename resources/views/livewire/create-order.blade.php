<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="{{ __('Contact Name') }}"/>
                <x-jet-input type="text"
                            wire:model.defer="contact"
                            placeholder="{{ __('Placeholder Contact Name') }}"
                            class="w-full"/>

                <x-jet-input-error for="contact" />
            </div>

            <div>
                <x-jet-label value="{{ __('Contact Phone') }}" />
                <x-jet-input type="text"
                            wire:model.defer="phone"
                            placeholder="{{ __('Placeholder Contact Phone') }}"
                            class="w-full"/>
                            
                <x-jet-input-error for="phone" />
            </div>
        </div>

        <div x-data="{ shipping_type: @entangle('shipping_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">{{ __('Shipments') }}</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="shipping_type" type="radio" value="1" name="shipping_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    {{ __('Pick On Store') . ' (Calle falsa 123)' }}
                </span>

                <span class="font-semibold text-gray-700 ml-auto">
                    {{ __('Free') }}
                </span>
            </label>
            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="shipping_type" type="radio" value="2" name="shipping_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        {{ __('Home Delivery') }}
                    </span>
                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': shipping_type != 2 }">

                    {{-- Departamentos --}}
                    <div>
                        <x-jet-label value="Departamento" />
                        
                        <select class="form-control w-full" wire:model="department_id">
                            <option value="" disabled selected>{{ __('Select Department') }}</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="department_id" />                        
                    </div>

                    {{-- Ciudades --}}
                    <div>
                        <x-jet-label value="Ciudad" />
                        
                        <select class="form-control w-full" wire:model="city_id">
                            <option value="" disabled selected>{{ __('Select City') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="city_id" />                        
                    </div>

                    {{-- Distritos --}}
                    <div>
                        <x-jet-label value="Distrito" />
                        
                        <select class="form-control w-full" wire:model="district_id">
                            <option value="" disabled selected>{{ __('Select City') }}</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="district_id" />                        
                    </div>

                    <div>
                        <x-jet-label value="{{ __('Address') }}" />
                        <x-jet-input class="w-full" wire:model="address" type="text" />

                        <x-jet-input-error for="address" />     
                    </div>

                    <div class="col-span-2">
                        <x-jet-label value="{{ __('Reference') }}" />
                        <x-jet-input class="w-full" wire:model="reference" type="text" />

                        <x-jet-input-error for="reference" />       
                    </div>
                </div>
            </div>
        </div>

        <div>
            <x-jet-button 
                wire:loading.attr="disabled"
                wire:target="create_order"
                class="mt-6 mb-4"
                wire:click="create_order">
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
    
                            <p>{{ __('Coin') . ' ' . number_format($item->price, 2)}}</p>
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
                    <span class="font-semibold">
                        @if ($shipping_type == 1 || $shipping_cost == 0)
                            {{ __('Free') }}
                        @else
                            {{ __('Coin') . ' ' . $shipping_cost }}
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">                    
                    <span class="text-lg">{{ __('Total') }}</span>
                    @if ($shipping_type == 1)
                        {{ __('Coin') . ' ' . Cart::subtotal() }}
                    @else
                        {{ __('Coin') . ' ' . number_format(str_replace(',', '', Cart::subtotal()) + $shipping_cost, 2)}}
                    @endif                    
                </p>
            </div>
        </div>        
    </div>
</div>
