<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCrud extends Component
{
    public $products = [];

    // Form velden
    public $productId = null;
    public $name = '';
    public $description = '';
    public $category = '';
    public $tagsInput = ''; // comma-separated in de UI
    public $image_url = '';

    protected $rules = [
        'name'        => 'required|string|min:2',
        'description' => 'nullable|string',
        'category'    => 'nullable|string',
        'tagsInput'   => 'nullable|string',
        'image_url'   => 'nullable|url',
    ];

    public function render()
    {
        // haal alle producten op (laatste eerst)
        $this->products = Product::orderBy('_id', 'desc')->get();

        return view('livewire.product-crud');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name'        => $this->name,
            'description' => $this->description,
            'category'    => $this->category,
            'tags'        => $this->parseTags($this->tagsInput),
            'image_url'   => $this->image_url,
        ];

        if ($this->productId) {
            // UPDATE
            $product = Product::find($this->productId);
            if ($product) {
                $product->update($data);
            }
        } else {
            // CREATE
            Product::create($data);
        }

        $this->resetForm();
        session()->flash('message', 'Product opgeslagen.');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) return;

        $this->productId   = (string) $product->_id;
        $this->name        = $product->name ?? '';
        $this->description = $product->description ?? '';
        $this->category    = $product->category ?? '';
        $this->image_url   = $product->image_url ?? '';
        $this->tagsInput   = is_array($product->tags) ? implode(', ', $product->tags) : '';
    }

    public function delete($id)
    {
        if ($p = Product::find($id)) {
            $p->delete();
            session()->flash('message', 'Product verwijderd.');
        }
        // formulier leegmaken als je het net aan het bewerken was
        if ($this->productId === $id) {
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->productId   = null;
        $this->name        = '';
        $this->description = '';
        $this->category    = '';
        $this->tagsInput   = '';
        $this->image_url   = '';
    }

    private function parseTags(string $raw): array
    {
        if (trim($raw) === '') return [];
        // split op komma, trim spaties, verwijder lege items
        return array_values(array_filter(array_map(fn($t) => trim($t), explode(',', $raw))));
    }
}
