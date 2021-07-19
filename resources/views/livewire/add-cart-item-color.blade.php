<div x-data>
    <p class="text-xl text-gray-700">{{ __('Color') . ':'}}</p>
    <select wire:model="color_id" class="form-control w-full mt-2">
        <option value="" selected disabled>{{ __('Select Color') }}</option>
        @foreach ($colors as $color)
            <option class="capitalize" value="{{ $color->id }}">{{ $color->name }}</option>
        @endforeach
    </select>

    <p class="text-gray-700 my-4">
        <span class="font-semibold text-lg">
            {{ __('Stock') . ': '}}
        </span>
        {{ $quantity }}       
        {{-- @if ($quantity)
            {{ $quantity }}
        @else
            {{ $product->stock }}
        @endif --}}        
    </p>

    <div class="flex">
        <div class="mr-4">
            <x-jet-secondary-button 
                disabled
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement">
                -
            </x-jet-secondary-button>
            @if (!$quantity)  
                -
            @else
                <span class="mx-2 text-gray-700">{{ $qty }}</span>
            @endif
            <x-jet-secondary-button
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>

        <div class="flex-1">
            <x-button
                x-bind:disabled="!$wire.quantity"
                color="orange" 
                class="w-full"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
                {{ __('Add Cart') }}
            </x-button>
        </div>
    </div>
</div>
