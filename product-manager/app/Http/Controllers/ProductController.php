<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function askOllama(Request $request)
    {
        $productId = $request->productId;
        $product = Product::find($productId);

        $prompt = "Geef een korte, vriendelijke omschrijving van het product: {$product->name}";

        // Ollama aanroepen via command line
        $process = new Process(['ollama', 'run', 'llama2', $prompt]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $answer = $process->getOutput();

        return response()->json(['answer' => $answer]);
    }

}
