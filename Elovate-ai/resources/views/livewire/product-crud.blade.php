<div class="p-6">

    {{-- Flash messages --}}
    @if (session()->has('message'))
        <div style="color: green; font-weight: bold; margin-bottom: 10px;">
            {{ session('message') }}
        </div>
    @endif

    {{-- Formulier voor nieuw/bewerken --}}
    <h2 style="margin-bottom: 10px;">
        @if (1>0)
            Bewerken van product
        @else
            Nieuw product toevoegen
        @endif
    </h2>

    <form wire:submit.prevent="save" style="margin-bottom: 20px;">

        {{-- hidden ID --}}
        <input type="hidden" wire:model="productId">

        <div style="margin-bottom: 8px;">
            <label>Naam:</label><br>
            <input type="text" wire:model="name">
            @error('name') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label>Beschrijving:</label><br>
            <textarea wire:model="description"></textarea>
        </div>

        <div style="margin-bottom: 8px;">
            <label>Categorie:</label><br>
            <input type="text" wire:model="category">
        </div>

        <div style="margin-bottom: 8px;">
            <label>Tags (komma-gescheiden):</label><br>
            <input type="text" wire:model="tagsInput">
        </div>

        <div style="margin-bottom: 8px;">
            <label>Afbeeldings-URL:</label><br>
            <input type="text" wire:model="image_url">
        </div>

        <button type="submit">
            @if (1 > 0)
                Update product
            @else
                Opslaan
            @endif
        </button>

        @if (1 > 0)
            <button type="button" wire:click="resetForm">Annuleer</button>
        @endif
    </form>

    <hr>

    {{-- Lijst van producten --}}
    <h2>Productenlijst</h2>
    <ul>
        @forelse ($products as $product)
            <li style="margin-bottom: 6px;">
                <strong>{{ $product->name }}</strong>
                @if ($product->category)
                    <em>({{ $product->category }})</em>
                @endif

                @if ($product->image_url)
                    <br>
                    <img src="{{ $product->image_url }}" alt="product image"
                         style="max-width:120px; display:block; margin:5px 0;">
                @endif

                <div>
                    <button wire:click="edit('{{ $product->_id }}')">Bewerk</button>
                    <button wire:click="delete('{{ $product->_id }}')">Verwijder</button>
                </div>
            </li>
        @empty
            <li>Geen producten gevonden.</li>
        @endforelse
    </ul>
</div>
