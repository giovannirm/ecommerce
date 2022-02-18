@props(['category'])

<div class="p-4">    
    <div class="flex items-baseline mb-4 ml-4">
        <span class="flex justify-center text-orange-500 items-center mx-2">
            {!! $category->icon !!}
        </span>
        <p class="text-2xl text-orange-500">
            {{ $category->name }}
        </p>
    </div>
    <div class="grid grid-cols-3 items-center">
        @foreach ($category->subcategories as $subcategory)
            <div class="bg-white rounded-lg mx-4 mb-4 text-center">
                <a href="{{ route('categories.show', $category) . '?filter_subcategory=' . $subcategory->slug }}" class="text-trueGray-500 inline-block font-semibold py-1 px-4 hover:text-orange-500">
                    {{ $subcategory->name }}
                </a>
            </div>
        @endforeach
    </div>
</div>

{{-- <div class="grid grid-cols-4 p-4">
    <div>
        <p class="text-lg font-bold text-center text-trueGray-500 mb-3">
            {{ __('Subcategories') }}
        </p>
        <ul>
            @foreach ($category->subcategories as $subcategory)
                <li>
                    <a href="" class="text-trueGray-500 inline-block font-semibold py-1 px-4 hover:text-orange-500">
                        {{ $subcategory->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div> 

    <div class="col-span-3">
        <img class="h-64 w-full object-cover object-center rounded-lg" src="{{ Storage::url($category->image) }}" alt="">
    </div>
</div> --}}