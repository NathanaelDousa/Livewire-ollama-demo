<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg flex flex-col md:flex-row gap-6">
    <!-- Linkerkant: tekst -->
    <div class="flex-1">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <p class="text-gray-700 mb-2"><span class="font-semibold">Beschrijving:</span> {{ $product->description }}</p>
        <p class="text-gray-700 mb-2"><span class="font-semibold">Categorie:</span> {{ $product->category }}</p>
        <div class="flex flex-wrap mt-4">
            @foreach($product->tags as $tag)
                <span class="inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded mr-2 mb-2">{{ $tag }}</span>
            @endforeach
        </div>
        <div class="mt-6">
    <button 
        id="ollamaButton"
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow"
    >
        AI suggestions
    </button>
</div>
    </div>

    <!-- Rechterkant: afbeelding -->
    <div class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg object-cover">
    </div>
</div>