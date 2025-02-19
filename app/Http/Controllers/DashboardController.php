<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\GradeLevel;
use App\Models\Location;
use App\Models\MeetupLocation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserType;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Add this at the top with other imports

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Initialize all variables with default values
        $totalOrders = Order::where('buyer_id', $user->id)->count();
        $activeOrders = Order::where('buyer_id', $user->id)
            ->whereNotIn('status', ['Completed', 'Cancelled'])
            ->count();
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        $totalSales = 0; // Initialize with 0 for non-sellers
        $activeProducts = 0;
        $pendingOrders = 0;

        // Additional data for sellers
        if ($user->is_seller) {
            $totalSales = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Completed');
                })
                ->sum('subtotal');

            $activeProducts = Product::where('seller_code', $user->seller_code)
                ->where('status', 'Active')
                ->count();

            $pendingOrders = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Pending');
                })->count();
        }

        return view('dashboard.dashboard', compact(
            'totalOrders',
            'activeOrders',
            'wishlistCount',
            'totalSales',
            'activeProducts',
            'pendingOrders'
        ));
    }

    public function profile()
    {
        $user = auth()->user();

        // Initialize stats with default values
        $totalOrders = Order::where('buyer_id', $user->id)->count();
        $activeOrders = Order::where('buyer_id', $user->id)
            ->whereNotIn('status', ['Completed', 'Cancelled'])
            ->count();
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        $totalSales = 0;
        $activeProducts = 0;
        $pendingOrders = 0;

        // Additional data for sellers
        if ($user->is_seller) {
            $totalSales = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Completed');
                })
                ->sum('subtotal');

            $activeProducts = Product::where('seller_code', $user->seller_code)
                ->where('status', 'Active')
                ->count();

            $pendingOrders = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Pending');
                })->count();
        }

        $is_student = $user->user_type_id == 2;
        $is_seller = $user->is_seller;
        $profile_picture = $user->profile_picture;
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $username = $user->username;
        $email = $user->email;
        $wmsu_id_front = $user->wmsu_id_front;
        $wmsu_id_back = $user->wmsu_id_back;
        $departments = Department::all();
        $gradeLevels = GradeLevel::all();

        return view('dashboard.profile', compact(
            'user',
            'is_student',
            'is_seller',
            'profile_picture',
            'first_name',
            'last_name',
            'username',
            'email',
            'wmsu_id_front',
            'wmsu_id_back',
            'departments',
            'gradeLevels',
            'totalOrders',
            'activeOrders',
            'wishlistCount',
            'totalSales',
            'activeProducts',
            'pendingOrders'
        ));
    }

    public function wishlist()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())
            ->with('product')
            ->paginate(10);

        return view('dashboard.wishlist', compact('wishlists'));
    }

    public function orders()
    {
        $orders = Order::where('buyer_id', auth()->id())
            ->with(['items.product'])
            ->latest()
            ->paginate(10);

        return view('dashboard.orders', compact('orders'));
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

    public function reviews()
    {
        return $this->index();
    }

    public function products()
    {
        $user = auth()->user();

        // Get seller statistics
        $totalSales = 0;
        $activeProducts = 0;
        $pendingOrders = 0;
        $products = collect(); // Initialize empty collection for products
        $categories = \App\Models\Category::all(); // Add categories for the form

        if ($user->is_seller) {
            $totalSales = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Completed');
                })
                ->sum('subtotal');

            $activeProducts = Product::where('seller_code', $user->seller_code)
                ->where('status', 'Active')
                ->count();

            $pendingOrders = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Pending');
                })->count();

            // Get paginated products
            $products = Product::where('seller_code', $user->seller_code)
                ->with(['category'])
                ->latest()
                ->paginate(10);
        }

        return view('dashboard.seller.products', compact(
            'totalSales',
            'activeProducts',
            'pendingOrders',
            'products',
            'categories'
        ));
    }

    public function analytics()
    {
        return $this->index();
    }

    public function removeFromWishlist(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action');
        }

        $wishlist->delete();
        return back()->with('success', 'Item removed from wishlist');
    }

    public function address()
    {
        $user = auth()->user();
        $meetupLocations = $user->meetupLocations()
            ->with('location')
            ->orderByDesc('is_default')
            ->latest()
            ->get();
        $locations = Location::all();

        // Add seller statistics
        $totalSales = 0;
        $activeProducts = 0;
        $pendingOrders = 0;

        if ($user->is_seller) {
            $totalSales = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Completed');
                })
                ->sum('subtotal');

            $activeProducts = Product::where('seller_code', $user->seller_code)
                ->where('status', 'Active')
                ->count();

            $pendingOrders = OrderItem::where('seller_code', $user->seller_code)
                ->whereHas('order', function ($query) {
                    $query->where('status', 'Pending');
                })->count();
        }

        return view('dashboard.address', compact(
            'user',
            'meetupLocations',
            'locations',
            'totalSales',
            'activeProducts',
            'pendingOrders'
        ));
    }

    public function showSellerRegistration()
    {
        if (auth()->user()->is_seller) {
            return redirect()->route('dashboard');
        }
        return view('dashboard.become-seller');
    }

    public function showSellerTerms()
    {
        if (auth()->user()->is_seller) {
            return redirect()->route('dashboard');
        }
        return view('dashboard.seller.terms');
    }

    public function acceptSellerTerms(Request $request)
    {
        $request->validate([
            'acceptTerms' => 'required|accepted'
        ]);

        $user = auth()->user();
        $user->is_seller = true;
        $user->seller_code = 'S' . str_pad($user->id, 5, '0', STR_PAD_LEFT);
        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Congratulations! You are now registered as a seller.');
    }

    private function uploadImage($request, $user, $userType, $validated)
    {
        if ($request->hasFile('profile_picture')) {
            $oldPicture = $user->profile_picture;
            $path = $request->file('profile_picture')->store($userType . '/profile_pictures', 'public');
            $validated['profile_picture'] = $path;

            if ($oldPicture) {
                Storage::disk('public')->delete($oldPicture);
            }
        }

        // Handle WMSU ID front
        if ($request->hasFile('wmsu_id_front')) {
            $oldFront = $user->wmsu_id_front;
            $path = $request->file('wmsu_id_front')->store($userType . '/id_front', 'public');
            $validated['wmsu_id_front'] = $path;

            if (isset($oldFront)) {
                Storage::disk('public')->delete($oldFront);
            }
        }

        // Handle WMSU ID back
        if ($request->hasFile('wmsu_id_back')) {
            $oldBack = $user->wmsu_id_back;
            $path = $request->file('wmsu_id_back')->store($userType . '/id_back', 'public');
            $validated['wmsu_id_back'] = $path;

            if (isset($oldBack)) {
                Storage::disk('public')->delete($oldBack);
            }
        }

        return $validated;
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        try {
            // Get user type code
            $userType = UserType::find($user->user_type_id);
            if (!$userType) {
                throw new \Exception('User type not found');
            }

            // Basic validation
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'date_of_birth' => 'nullable|date',
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'wmsu_email' => 'required|string|email|max:255|unique:users,wmsu_email,' . $user->id,
                'wmsu_dept_id' => 'nullable|exists:departments,id',
                'grade_level_id' => 'nullable|exists:grade_levels,id',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'wmsu_id_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'wmsu_id_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle profile picture
            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $validated['profile_picture'] = $request->file('profile_picture')
                    ->store($userType->code . '/profile_pictures', 'public');
            }

            // Handle ID front
            if ($request->hasFile('wmsu_id_front')) {
                if ($user->wmsu_id_front) {
                    Storage::disk('public')->delete($user->wmsu_id_front);
                }
                $validated['wmsu_id_front'] = $request->file('wmsu_id_front')
                    ->store($userType->code . '/id_front', 'public');
            }

            // Handle ID back
            if ($request->hasFile('wmsu_id_back')) {
                if ($user->wmsu_id_back) {
                    Storage::disk('public')->delete($user->wmsu_id_back);
                }
                $validated['wmsu_id_back'] = $request->file('wmsu_id_back')
                    ->store($userType->code . '/id_back', 'public');
            }

            // Update user
            $user->update($validated);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            Log::error('Profile update error', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to update profile: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function storeMeetupLocation(Request $request)
    {
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'location_id' => 'required|exists:locations,id',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'available_from' => 'required',
                'available_until' => 'required|after:available_from',
                'available_days' => 'required|array',
                'available_days.*' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
                'max_daily_meetups' => 'required|integer|min:1|max:50',
                'is_default' => 'nullable|boolean',
            ]);

            $user = auth()->user();

            // Check if trying to set as default when another default exists
            if (
                $request->has('is_default') &&
                !$request->has('confirmed_default_change') &&
                $user->meetupLocations()->where('is_default', true)->exists()
            ) {

                return response()->json([
                    'needs_confirmation' => true,
                    'message' => 'Another location is already set as default. Do you want to make this location the new default?',
                    'data' => $validated
                ]);
            }

            // If setting as default or confirmed, remove default from others
            if ($request->has('is_default') || $request->has('confirmed_default_change')) {
                $user->meetupLocations()->update(['is_default' => false]);
            }

            $meetupLocation = $user->meetupLocations()->create([
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'location_id' => $validated['location_id'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'available_from' => $validated['available_from'],
                'available_until' => $validated['available_until'],
                'available_days' => json_encode($validated['available_days']),
                'max_daily_meetups' => $validated['max_daily_meetups'],
                'is_default' => $request->has('is_default') || $request->has('confirmed_default_change'),
                'is_active' => true,
            ]);

            // If this is the first location, make it default
            if ($user->meetupLocations()->count() === 1) {
                $meetupLocation->update(['is_default' => true]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Meetup location added successfully',
                'redirect' => route('dashboard.address')
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing meetup location: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add meetup location: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateMeetupLocation(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'location_id' => 'required|exists:locations,id',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'available_from' => 'required',
                'available_until' => 'required|after:available_from',
                'available_days' => 'required|array',
                'available_days.*' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
                'max_daily_meetups' => 'required|integer|min:1|max:50',
                'is_default' => 'nullable|boolean',
            ]);

            $user = auth()->user();
            $meetupLocation = $user->meetupLocations()->findOrFail($id);

            // Check if trying to set as default when another default exists
            if (
                $request->has('is_default') &&
                !$request->has('confirmed_default_change') &&
                !$meetupLocation->is_default &&
                $user->meetupLocations()->where('is_default', true)->exists()
            ) {

                return response()->json([
                    'needs_confirmation' => true,
                    'message' => 'Another location is already set as default. Do you want to make this location the new default?',
                    'data' => $validated
                ]);
            }

            // If setting as default or confirmed, remove default from others
            if (($request->has('is_default') || $request->has('confirmed_default_change')) && !$meetupLocation->is_default) {
                $user->meetupLocations()->where('id', '!=', $id)->update(['is_default' => false]);
            }

            $meetupLocation->update([
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'location_id' => $validated['location_id'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'available_from' => $validated['available_from'],
                'available_until' => $validated['available_until'],
                'available_days' => json_encode($validated['available_days']),
                'max_daily_meetups' => $validated['max_daily_meetups'],
                'is_default' => $request->has('is_default') || $request->has('confirmed_default_change') || $meetupLocation->is_default,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Meetup location updated successfully',
                'redirect' => route('dashboard.address')
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating meetup location: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update meetup location: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteMeetupLocation($id)
    {
        try {
            $user = auth()->user();
            $location = $user->meetupLocations()->findOrFail($id);
            $wasDefault = $location->is_default;

            $location->delete();

            // If we deleted the default location, make another one default
            if ($wasDefault) {
                $newDefault = $user->meetupLocations()->first();
                if ($newDefault) {
                    $newDefault->update(['is_default' => true]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Meetup location deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting meetup location: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting meetup location: ' . $e->getMessage()
            ], 500);
        }
    }
}
