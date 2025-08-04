<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        // Get or create customer record for the authenticated user
        $customer = Customer::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '',
                'id_number' => '',
                'address' => '',
            ]
        );
        
        return view('profile.show', compact('customer'));
    }

    public function edit()
    {
        // Get or create customer record for the authenticated user
        $customer = Customer::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '',
                'id_number' => '',
                'address' => '',
            ]
        );
        
        return view('profile.edit', compact('customer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        // Update User model
        $request->user()->update([
            'name' => $request->name
        ]);

        // Get or create and update Customer model
        $customer = Customer::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'email' => Auth::user()->email,
                'phone' => '',
                'id_number' => '',
                'address' => '',
            ]
        );

        $customer->update([
            'name' => $request->name,
            'email' => Auth::user()->email,
            'phone' => $request->phone ?? '',
            'address' => $request->address ?? '',
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
    public function password(Request $request)
    {
        // If it's a GET request, show the password change form
        if ($request->isMethod('get')) {
            return view('profile.password');
        }
        
        // If it's a POST request, handle password update
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!\Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $request->user()->update(['password' => \Hash::make($request->new_password)]);
        return back()->with('success', 'Password updated successfully.');
    }
    public function destroy(Request $request)
    {
        $request->user()->delete();
        return redirect('/')->with('success', 'Profile deleted successfully.');
    }
}
