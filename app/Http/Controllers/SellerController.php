<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Make sure to create Product model
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function create()
    {
        return view('seller.addproduct');
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'trade_method' => 'required|in:sell,trade,all',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'trade_method' => $validated['trade_method'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'images' => json_encode($imagePaths),
            'user_id' => auth()->id()  
        ]);

        return redirect()->route('seller.products.add')
            ->with('success', 'Product added successfully!');
    }
}
