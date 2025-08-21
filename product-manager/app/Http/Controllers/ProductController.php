<?php


namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request; // <--- hier was je import voor Request
use Symfony\Component\Process\Process; // <--- voor Process
use Symfony\Component\Process\Exception\ProcessFailedException; // <--- voor ProcessFailedException

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
        $product = Product::findOrFail($productId); // vind product of gooi 404

        $prompt = "Geef een korte, vriendelijke omschrijving van het product: {$product->name}";

        $process = new Process(['ollama', 'run', 'llama2', $prompt]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $answer = $process->getOutput();

        return response()->json(['answer' => $answer]);
    }
}

