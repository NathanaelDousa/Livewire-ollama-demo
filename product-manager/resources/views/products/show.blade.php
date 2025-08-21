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
            <button id="ask-ollama" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Vraag Ollama
            </button>
            <div id="ollama-response" class="mt-4 text-gray-800"></div>
            <div id="ollama-spinner" class="mt-2 hidden">
                <svg class="animate-spin h-6 w-6 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <p class="text-center text-gray-500">Ollama is aan het denken...</p>
            </div>
        </div>

        <div id="ollamaResponse" class="mt-4 p-4 bg-gray-100 rounded hidden"></div>
    </div>

    <!-- Rechterkant: afbeelding -->
    <div class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg object-cover">
    </div>
</div>

<script>
document.getElementById('ask-ollama').addEventListener('click', function() {
    const spinner = document.getElementById('ollama-spinner');
    const responseDiv = document.getElementById('ollama-response');

    spinner.classList.remove('hidden'); // show spinner
    responseDiv.innerHTML = ''; // clear previous response

    fetch('/ollama', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ productId: '{{ $product->id }}' })
    })
    .then(res => res.json())
    .then(data => {
        spinner.classList.add('hidden'); // hide spinner
        responseDiv.innerHTML = `<p>${data.answer}</p>`;
    })
    .catch(err => {
        spinner.classList.add('hidden'); // hide spinner
        responseDiv.innerHTML = `<p class="text-red-600">Er is iets misgegaan: ${err.message}</p>`;
    });
});
</script>

