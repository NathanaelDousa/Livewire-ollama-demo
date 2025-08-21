<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class CreateProduct extends Component
{
    public $name = "";
    public $description = "";
    public $category = "";
    public $tags = [];

    public function render()
    {
        return view('livewire.create-product');
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'tags' => 'required', // tags als array
        ]);
        // dd($validated);

        // Opslaan in MongoDB
        $validated['tags'] = explode(',', $this->tags); 
        $validated['image'] = 'https://placehold.co/600x400';

        Product::create($validated);

        // Flash message
        session()->flash('success', 'Product succesvol opgeslagen!');

        // Redirect of update component view
        return redirect()->to('/products'); // of naar een andere route
    }
}
