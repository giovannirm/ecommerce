<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                            <li data-thumb="{{ Storage::url($image->url) }}">
                                <img src="{{ Storage::url($image->url) }}"/>
                            </li>
                        @endforeach                        
                    </ul>
                </div>
            </div>
            <div>
                <h1 class="text-xl font-bold text-trueGray-700">
                    {{ $product->name }}
                </h1>

                <div class="flex">
                    <p class="text-trueGray-700">{{ __('Brand') }}: 
                        <a href="" class="underline capitalize hover:text-orange-500">
                            {{ $product->brand->name }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>