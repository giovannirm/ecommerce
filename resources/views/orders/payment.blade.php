<x-app-layout>

    @php
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        $shipments = new MercadoPago\Shipments();
        
        // shipping_cost es el costo de envío
        $shipments->cost = $order->shipping_cost;
        $shipments->mode = "not_specified";

        $preference->shipments = $shipments;

        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;

            $products[] = $item;
        }

        $preference->back_urls = array(
            "success" => route('orders.pay', $order),
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";

        $preference->items = $products;
        $preference->save();
    @endphp
    <!-- El método config nos posiciona en la carpeta config -->
    
    <div class="grid grid-cols-5 gap-6 container py-8">
        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase">
                    <span class="font-semibold">{{ __('Number Order') . ': ' }}</span>
                    {{ __('Order') . '-' . $order->id }}
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div class="flex flex-col justify-centerr">
                        <p class="text-lg font-semibold uppercase">{{ __('Shipping Address') }}</p>

                        @if ($order->shipping_type == 1)
                            <p class="text-sm">{{ __('Products Must Be Picked Up At The Store') }}</p>
                            <p class="text-sm">calle falsa 123</p>
                        @else
                            <p class="text-sm">{{ __('Products Will Be Shipped To') . ':' }}</p>
                            <p class="text-sm">{{ $order->address }}</p>
                            <p class="text-sm uppercase">{{ $order->department->name . ' - ' . $order->city->name . ' - ' . $order->district->name }}</p>

                            <p class="text-sm">{{ __('Reference') . ': ' . $order->reference}}</p>
                        @endif
                    </div>

                    <div class="flex flex-col justify-center items-center">
                        <p class="text-lg font-semibold uppercase">{{ __('Contact Information') }}</p>

                        <p class="text-sm">{{ __('Person Who Will Receive The Product') . ': ' . $order->contact }}</p>
                        <p class="text-sm">{{ __('Contact Phone') . ': ' . $order->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6 text-gray-700">
                <p class="text-xl font-semibold uppercase mb-4">{{ __('Abstract') }}</p>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <img 
                                            class="h-15 w-20 object-cover object-center mr-4 rounded-lg" 
                                            src="{{ $item->options->image }}" alt="">

                                        <article>
                                            <h1 class="font-bold">{{ $item->name }}</h1>
                                            <div class="flex text-xs">

                                                @isset ($item->options->color)
                                                    {{ __('Color') . ': ' . $item->options->color }}
                                                @endisset

                                                @isset ($item->options->size)
                                                    {{ '- ' . $item->options->size }}
                                                @endisset

                                            </div>
                                        </article>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ __('Coin') . ' ' . number_format($item->price, 2) }}
                                </td>
                                <td class="text-center">
                                    {{ $item->qty }}
                                </td>
                                <td class="text-center">
                                    {{ __('Coin') . ' ' . number_format($item->price  * $item->qty, 2) }}
                                </td>
                            </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6 ">
                <div class="flex justify-between items-center">
                    <img class="h-8" src="{{ asset('img/medio_pago.png') }}" alt="">
                    <div class="w-48">                
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700">
                                {{ __('Subtotal') . ':' }}
                            </span>
                            <p class="text-red-600">
                                {{ __('Coin') . ' ' . number_format($order->total - $order->shipping_cost, 2) }}
                            </p>
                        </div>  
                        <div class="divide-y divide-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">
                                    {{ __('Shipment') . ':' }}
                                </span>
                                <p class="text-red-600">
                                    {{ __('Coin') . ' ' . number_format($order->shipping_cost, 2) }}
                                </p>
                            </div>  
                            <div class="flex justify-between font-bold items-center uppercase">
                                <span class="text-gray-700">
                                    {{ __('Total') . ':' }}
                                </span>
                                <p class="text-red-600">
                                    {{ __('Coin') . ' ' . number_format($order->total, 2) }}
                                </p>                        
                            </div>
                            <div class="cho-container">
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>

    <!-- SDK MercadoPago.js V2 -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        // Agrega credenciales de SDK
        const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                locale: 'es-AR'
        });

        // Inicializa el checkout
        mp.checkout({
            preference: {
                id: '{{ $preference->id }}'
            },
            render: {
                    container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                    label: 'Pagar', // Cambia el texto del botón de pago (opcional)
            }
        });
    </script>
</x-app-layout>