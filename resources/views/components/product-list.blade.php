@props(['product'])

<li class="bg-white rounded-lg shadow mb-4">
    <article class="flex">
        <figure>
            <img class="h-full w-56 rounded-l-lg object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
        </figure>

        <div class="flex-1 py-4 px-6 flex flex-col">
            <div class="flex flex-col lg:flex-row lg:justify-between">
                <div class="text-base">
                    <h1 class="font-semibold text-trueGray-700">{{ $product->name }}</h1>
                    <p class="font-bold text-gray-700">{{ __('Coin') }} {{ $product->price }}</p>
                </div>

                <div class="flex items-center">
                    <ul class="flex text-sm">
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                    </ul>

                    <span class="text-gray-700 text-sm">(24)</span>
                </div>                                        
            </div>  
            
            <div class="mt-auto">                                        
                <x-danger-button href="{{ route('products.show', $product) }}"> 
                    {{ __('More Information') }}
                </x-button-danger>                                                                      
            </div>
        </div>
    </article>
</li>