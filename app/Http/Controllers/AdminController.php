<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.adminlogin');
    }

    public function login(Request $request)
    {
        // Validate
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Try to login the user
        if (Auth::attempt($credentials, $request->remember)) {
            // Check if user is admin
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }
            
            Auth::logout();
            return back()->withErrors([
                'failed' => 'You do not have admin privileges'
            ]);
        }

        return back()->withErrors([
            'failed' => 'The provided credentials do not match our records'
        ]);
    }

    public function logout(Request $request) {
    Auth::logout();
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('admin.login');
}

//     public function dashboard()
//     {
//         $totalUsers = User::count();
//         $totalProducts = Product::count();
//         $totalTransactions = Transaction::sum('amount');
        
//         return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalTransactions'));
//     }

//     public function users()
//     {
//         $users = User::paginate(10);
//         return view('admin.users.index', compact('users'));
//     }

//     public function products()
//     {
//         $products = Product::paginate(10);
//         return view('admin.products.index', compact('products'));
//     }

//     public function transactions()
//     {
//         $transactions = Transaction::with(['user'])->paginate(10);
//         return view('admin.transactions.index', compact('transactions'));
//     }

//     public function reports()
//     {
//         $salesData = Transaction::select(
//             DB::raw('DATE(created_at) as date'),
//             DB::raw('SUM(amount) as total')
//         )
//         ->groupBy('date')
//         ->orderBy('date', 'DESC')
//         ->get();

//         return view('admin.reports', compact('salesData'));
//     }

//     public function profile()
//     {
//         return view('admin.profile');
//     }

//     public function updateProfile(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email,' . auth()->id(),
//         ]);

//         auth()->user()->update($validated);

//         return redirect()->back()->with('success', 'Profile updated successfully');
//     }
 }
