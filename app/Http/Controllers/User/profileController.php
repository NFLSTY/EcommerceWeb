<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your profile.');
        }

        // Add calculated fields for profile display
        $user->profile_image_url = $user->profile_image 
            ? asset('storage/profile_images/' . $user->profile_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';
        
        $user->member_since = $user->created_at;
        $user->total_orders = $user->order()->count();
        $user->total_spent = $user->order()->sum('total') ?? 0;
        $user->wishlist_count = 0; // Will be updated when wishlist is implemented
        $user->loyalty_points = floor($user->total_spent / 100000); // 1 point per 100k spent

        return view('user.profile_show', compact('user'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to edit your profile.');
        }

        // Add profile image URL for display
        $user->profile_image_url = $user->profile_image 
            ? asset('storage/profile_images/' . $user->profile_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';

        return view('user.profile_edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to update your profile.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);
        
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's profile image.
     */
    public function updateProfileImage(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete('profile_images/' . $user->profile_image);
            }

            // Store new image
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $user->id . '.' . $image->getClientOriginalExtension();
            $image->storeAs('profile_images', $imageName, 'public');

            // Update user record
            $user->update(['profile_image' => $imageName]);

            $imageUrl = asset('storage/profile_images/' . $imageName);
        } else {
            $imageUrl = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile image updated successfully!',
            'image_url' => $imageUrl
        ]);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to update your password.');
        }

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        
        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }

    /**
     * Display user's orders.
     */
    public function orders()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your orders.');
        }

        // Get user's orders with order items and products
        $orders = $user->order()->with(['orderItems.product'])->orderBy('created_at', 'desc')->get();

        // Add profile image URL
        $user->profile_image_url = $user->profile_image 
            ? asset('storage/profile_images/' . $user->profile_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';

        return view('user.profile_orders', compact('user', 'orders'));
    }

    /**
     * Display specific order details.
     */
    public function orderDetail($orderNumber)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view order details.');
        }

        // Find the order by order number and ensure it belongs to the user
        $order = $user->order()
            ->with(['orderItems.product', 'payment'])
            ->where('order_number', $orderNumber)
            ->first();

        if (!$order) {
            return redirect()->route('profile.orders')->with('error', 'Order not found.');
        }

        // Add profile image URL
        $user->profile_image_url = $user->profile_image 
            ? asset('storage/profile_images/' . $user->profile_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';

        return view('user.profile_order_detail', compact('user', 'order'));
    }

    /**
     * Display user's wishlist.
     */
    public function wishlist()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }

        // For now, return empty wishlist since wishlist functionality isn't implemented yet
        $wishlistItems = collect([]);

        // Add profile image URL
        $user->profile_image_url = $user->profile_image 
            ? asset('storage/profile_images/' . $user->profile_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';

        return view('user.profile_wishlist', compact('user', 'wishlistItems'));
    }

    /**
     * Display user's notifications.
     */
    public function notifications()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your notifications.');
        }

        // For now, return empty notifications since notification system isn't implemented yet
        $notifications = collect([]);

        // Add profile image URL
        $user->profile_image_url = $user->profile_image 
            ? asset('storage/profile_images/' . $user->profile_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';

        return view('user.profile_notifications', compact('user', 'notifications'));
    }

    /**
     * Profile testing dashboard - remove this before production
     */
    public function profileTesting()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access profile testing.');
        }

        // Add profile image URL
        $user->profile_image_url = $user->profile_image 
            ? asset('storage/profile_images/' . $user->profile_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4a90e2&color=ffffff&size=120';

        return view('user.profile_testing', compact('user'));
    }
}
