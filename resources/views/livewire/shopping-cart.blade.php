<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="uppercase text-lg font-semibold mb-6">{{ __('Shopping Cart') }}</h1>

        @if (Cart::count())           
        
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Total') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr class="text-center">
                            <td class="text-left">
                                <div class="flex items-center">
                                    <img class="h-15 w-20 object-cover mr-4 rounded-lg" src="{{ $item->options->image }}" alt="">
                                    <div>
                                        <p class="font-bold">{{ $item->name }}</p>
                                        @if ($item->options->color)
                                            <span>
                                                {{ __('Color') . ': ' . $item->options->color }}
                                            </span>
                                        @endif
                                        @if ($item->options->size)
                                            <span class="mx-1">
                                                -
                                            </span>
                                            <span>
                                                {{ $item->options->size }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span>{{ __('Coin') . $item->price }}</span>
                                <a 
                                    class="ml-6 cursor-pointer hover:text-red-600" 
                                    wire:click="delete('{{ $item->rowId }}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="delete('{{ $item->rowId }}')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td>
                                @if ($item->options->size)
                                    @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
                                @elseif ($item->options->color)
                                    @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                @else
                                    @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                @endif                           
                            </td>
                            <td>
                                {{ __('Coin') . $item->price * $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a 
                class="text-sm cursor-pointer hover:underline mt-3 inline-block"
                wire:click="destroy">
                <i class="fas fa-trash"></i>
                {{ __('Delete Shopping Cart') }}
            </a>

        @else
            <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 my-4 uppercase">
                    {{ __('Your Shopping Cart Is Empty') }}
                </p>
                <x-button-link href="/" class="px-16">
                    {{ __('Go To Start') }}
                </x-button-link>
            </div>
        @endif
    </section>

    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">{{ __('Total') . ':' }}</span>
                        {{ __('Coin') . Cart::subtotal() }}
                    </p>
                </div>
                <div>
                    <x-button-link href="{{ route('orders.create') }}">
                        {{ __('Continue') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    @endif
</div>
