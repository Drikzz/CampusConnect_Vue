<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('seller.orders.index');
    }

    public function pending()
    {
        return view('seller.orders.pending');
    }

    public function processing()
    {
        return view('seller.orders.processing');
    }

    public function completed()
    {
        return view('seller.orders.completed');
    }

    public function show(Order $order)
    {
        return view('seller.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated successfully');
    }
}
