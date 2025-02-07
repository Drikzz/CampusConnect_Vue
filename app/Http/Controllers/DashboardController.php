<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_seller == 1) {
            return redirect()->route('seller.dashboard');
        }

        $pendingOrders = Order::where('buyer_id', auth()->user()->id)
            ->where('status', 'pending')
            ->get();

        return view('buyer.dashboard', [
            'user' => auth()->user(),
            'user_type' => auth()->user()->user_type,
            'pendingOrders' => $pendingOrders
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $user_type = UserType::where('id', $user->user_type_id)->first()->name;
        $pendingOrders = Order::where('buyer_id', $user->id)
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

        $pendingOrders = Order::where('buyer_id', $user->id)
            ->where('status', 'pending')
            ->get();

        $toPayOrders = Order::where('buyer_id', $user->id)
            ->where('status', 'to-pay')
            ->get();

        $completedOrders = Order::where('buyer_id', $user->id)
            ->where('status', 'completed')
            ->get();

        return view('buyer.dashboard', [
            'user' => $user,
            'user_type' => $user_type,
            'pendingOrders' => $pendingOrders,
            'toPayOrders' => $toPayOrders,
            'completedOrders' => $completedOrders
        ]);
    }

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

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'wmsu_email' => 'required|email|unique:users,wmsu_email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new profile picture
            $profilePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $profilePath;
        }

        try {
            $user->update($validated);
            return back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update profile. Please try again.');
        }
    }
}
