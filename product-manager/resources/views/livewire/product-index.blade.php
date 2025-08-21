<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Producten Overzicht</h1>

    <div class="flex flex-wrap -mx-2">
        @foreach($products as $product)
            <div class="w-1/4 px-2 mb-4">
                <a href="{{ route('products.show', $product->_id) }}">
                    <div class="bg-white rounded shadow p-4 flex flex-col items-center">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded mb-2">
                        <h2 class="font-bold text-lg">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600">{{ $product->description }}</p>
                        <div class="mt-2 flex flex-wrap justify-center">
                            @foreach($product->tags as $tag)
                                <span class="bg-gray-200 px-2 py-1 rounded mr-1 mb-1 text-xs">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
