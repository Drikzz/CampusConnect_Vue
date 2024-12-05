<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class SellerController extends Controller
{

    public function index()
    {
        $sellerId = auth()->id();

        // Share order counts for the view
        $orderCounts = (object)[
            'pendingCount' => Auth::user()->soldOrders()->where('status', 'Pending')->count(),
            'processingCount' => Auth::user()->soldOrders()->where('status', 'Processing')->count(),
            'completedCount' => Auth::user()->soldOrders()->where('status', 'Completed')->count(),
        ];
        View::share('orderCounts', $orderCounts);

        // Get total orders
        $totalOrders = Order::where('seller_id', $sellerId)->count();

        // Calculate total sales
        $totalSales = Order::where('seller_id', $sellerId)
            ->where('status', 'Completed')
            ->sum('sub_total');

        // Get active trades (orders with payment_method as 'trade')
        $activeTrades = Order::where('seller_id', $sellerId)
            ->where('payment_method', 'trade')
            ->where('status', '!=', 'Completed')
            ->count();

        // Get recent orders
        $recentOrders = Order::where('seller_id', $sellerId)
            ->with('buyer')
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact('totalOrders', 'totalSales', 'activeTrades', 'recentOrders', 'orderCounts'));
    }

    public function create()
    {
        // Share order counts for the view
        $orderCounts = (object)[
            'pendingCount' => Auth::user()->soldOrders()->where('status', 'Pending')->count(),
            'processingCount' => Auth::user()->soldOrders()->where('status', 'Processing')->count(),
            'completedCount' => Auth::user()->soldOrders()->where('status', 'Completed')->count(),
        ];
        View::share('orderCounts', $orderCounts);

        $categories = Category::all();
        return view('seller.addproduct', compact('categories', 'orderCounts'));
    }

    public function store(Request $request)
    {
        // Share order counts for the view
        $orderCounts = (object)[
            'pendingCount' => Auth::user()->soldOrders()->where('status', 'Pending')->count(),
            'processingCount' => Auth::user()->soldOrders()->where('status', 'Processing')->count(),
            'completedCount' => Auth::user()->soldOrders()->where('status', 'Completed')->count(),
        ];
        View::share('orderCounts', $orderCounts);

        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to add products.');
        }

        // Get seller code from authenticated user
        $sellerCode = Auth::user()->seller_code;

        // dd($sellerCode);    
        if (!$sellerCode) {
            return redirect()->back()
                ->with('error', 'Seller code not found. Please update your profile.');
        }

        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id', // Changed from slug to id
            'trade_method' => 'required|in:sell,trade,both',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount' => 'nullable|numeric|min:0|max:100' // Add discount validation
        ]);

        // Handle images
        $imagePaths = [];

        // Handle main image (required)
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            $imagePaths[] = $path;
        }

        // Handle additional images (optional)
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                if ($image) {
                    $path = $image->store('products', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        // Map trade method name to ID
        $tradeMethodMap = [
            'sell' => 1, // Sell Only
            'trade' => 2, // Trade Only
            'both' => 3  // Both
        ];

        // Calculate discounted price if discount is provided
        $price = $validated['price'];
        $discount = $validated['discount'] ?? 0;
        $discountedPrice = $price - ($price * ($discount / 100));

        // Create product with explicit seller_code
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $price,
            'discount' => $discount,
            'discounted_price' => $discountedPrice,
            'stock' => $validated['quantity'],
            'quantity' => $validated['quantity'],
            'images' => $imagePaths,
            'seller_code' => $sellerCode,
            'category_id' => $validated['category'],
            'trade_method_id' => $tradeMethodMap[$validated['trade_method']]
        ]);

        return redirect()->route('seller.products')->compact('orderCounts')->with('success', 'Product added successfully!');
    }

    public function products()
    {
        // Share order counts for the view
        $orderCounts = (object)[
            'pendingCount' => Auth::user()->soldOrders()->where('status', 'Pending')->count(),
            'processingCount' => Auth::user()->soldOrders()->where('status', 'Processing')->count(),
            'completedCount' => Auth::user()->soldOrders()->where('status', 'Completed')->count(),
        ];
        View::share('orderCounts', $orderCounts);

        $sellerCode = Auth::user()->seller_code;
        $products = Product::where('seller_code', $sellerCode)
            ->with('category')  // Eager load category relationship
            ->latest()
            ->paginate(3);  // Show 10 items per page

        // dd($products);
        return view('seller.product', compact('products', 'orderCounts'));
    }
}
