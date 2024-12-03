<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    public function summary($id)
    {
        $product = Product::find($id);
        return view('products.order_sum', compact('product'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'delivery_estimate' => ['required', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'payment_method' => ['required', 'string', 'in:cash,gcash'],
        ]);

        $product = Product::find($request->product_id);

        // Check if there's enough stock
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'total' => $request->total,
            'status' => 'Pending',
            'payment_method' => $request->payment_method,
            'delivery_estimate' => $request->delivery_estimate,
        ]);

        // Create the order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->discounted_price,
        ]);

        // Deduct the stock
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('dashboard.orders')->with('success', 'Order has been placed');
    }
}
