<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,other'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's profile image.
     */
    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        // Delete old profile image if exists
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Store new profile image
        $path = $request->file('profile_image')->store('profile-images', 'public');

        $user->update(['profile_image' => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Profile image updated successfully!',
            'image_url' => $user->profile_image_url
        ]);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }

    /**
     * Get user orders (placeholder for future implementation).
     */
    public function orders()
    {
        // This would typically fetch orders from an Order model
        // For now, returning empty array
        $orders = [];
        
        return view('profile.orders', compact('orders'));
    }

    /**
     * Get user wishlist (placeholder for future implementation).
     */
    public function wishlist()
    {
        // This would typically fetch wishlist items from a Wishlist model
        // For now, returning empty array
        $wishlistItems = [];
        
        return view('profile.wishlist', compact('wishlistItems'));
    }

    /**
     * Show notification settings.
     */
    public function notifications()
    {
        $user = Auth::user();
        return view('profile.notifications', compact('user'));
    }

    /**
     * Update notification settings.
     */
    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => ['boolean'],
            'sms_notifications' => ['boolean'],
            'push_notifications' => ['boolean'],
        ]);

        // You might want to store these in a separate user_settings table
        // or add columns to the users table
        Auth::user()->update($validated);

        return redirect()->route('profile.notifications')->with('success', 'Notification settings updated!');
    }
}