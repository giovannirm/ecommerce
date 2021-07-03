<div>
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">{{ $category->name }}</h1>
            <div class="grid grid-cols-2 border-2 border-gray-200 divide-x divide-gray-200">
                <i class="fas fa-border-all p-3 text-gray-500 cursor-pointer {{ $view == 'grid' ? 'text-orange-500' : '' }}" wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list p-3 text-gray-500 cursor-pointer {{ $view == 'list' ? 'text-orange-500' : '' }}" wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 {{ $view == 'grid' ? 'sm:grid-cols-2' : '' }} md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside class="flex flex-col">         
            <h2 class="font-semibold text-center mb-2 py-1 bg-yellow-400 rounded-lg">{{ __('Subcategories') }}</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 text-sm">
                        <a 
                            class="cursor-pointer hover:text-orange-500 capitalize {{ $filter_subcategory == $subcategory->name ? 'text-orange-500 font-bold' : '' }}"
                            wire:click="$set('filter_subcategory', '{{ $subcategory->name }}')">
                            {{ $subcategory->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            
            <h2 class="font-semibold text-center mt-4 mb-2 py-1 bg-yellow-400 rounded-lg">{{ __('Brands') }}</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->brands as $brand)
                    <li class="py-2 text-sm">
                        <a 
                            class="cursor-pointer hover:text-orange-500 capitalize {{ $filter_brand == $brand->name ? 'text-orange-500 font-bold' : '' }}"
                            wire:click="$set('filter_brand', '{{ $brand->name }}')">
                            {{ $brand->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <x-jet-button class="mt-4 justify-center" wire:click="clean">
                {{ __('Remove filters') }}
            </x-jet-button>
        </aside>
        
        <div class="md:col-span-2 lg:col-span-4">
            
            @if ($view == 'grid')
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <li class="bg-white rounded-lg shadow">
                            <article>
                                <figure>
                                    <img class="h-48 w-full object-cover object-center rounded-t-lg" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                </figure>

                                <div class="py-4 px-6">
                                    <h1 class="text-lg font-semibold">
                                        <a href="{{ route('products.show', $product) }}">
                                            {{ Str::limit($product->name, 20) }}
                                        </a>
                                    </h1>

                                    <p class="font-bold text-gray-700">{{ __('Coin') }} {{ $product->price }}</p>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul> 
            @else
                <ul>
                    @foreach ($products as $product)
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
                    @endforeach
                </ul>
            @endif               

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>       
    </div>
</div>
