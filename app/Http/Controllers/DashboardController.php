<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_seller == 1) {
            return redirect()->route('seller.dashboard');
        }

        return view('buyer.dashboard', [
            'user' => auth()->user(),
            'user_type' => auth()->user()->user_type
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $user_type = UserType::where('id', $user->user_type_id)->first()->name;
        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();  // Add ->get() to execute the query

        return view('buyer.dashboard', [
            'user' => $user,
            'user_type' => $user_type,
            'pendingOrders' => $pendingOrders
        ]);
    }

    public function address()
    {
        return view('components.addressCard');
    }

    // public function orders($status)
    // {
    //     return view('components.myOrders');
    // }

    //static route for orders
    public function orders()
    {
        $user = Auth::user();
        $user_type = UserType::where('id', $user->user_type_id)->first()->name;
        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();

        return view('buyer.dashboard', [
            'user' => $user,
            'user_type' => $user_type,
            'pendingOrders' => $pendingOrders
        ]);
    }

    // public function orders()
    // {
    //     $user = Auth::user();
    //     $toPayOrders = Order::where('user_id', $user->id)->where('status', 'to-pay')->get();
    //     $completedOrders = Order::where('user_id', $user->id)->where('status', 'completed')->get();

    //     return view('dashboard', [
    //         'user' => $user,
    //         'toPayOrders' => $toPayOrders,
    //         'completedOrders' => $completedOrders,
    //     ]);
    // }

    public function favorites()
    {
        return view('components.myFavorites');
    }

    public function sell()
    {
        return view('components.sell');
    }

    public function terms()
    {
        return view('buyer.terms');
    }
}
