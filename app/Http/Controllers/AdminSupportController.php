<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminSupportController extends Controller
{
    /**
     * Display a listing of support staff.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'support');

        // Handle search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $supportStaff = $query->orderBy('created_at', 'desc')->paginate(15);

        // Append search parameter to pagination links
        $supportStaff->appends($request->query());

        return view('admin.support.index', compact('supportStaff'));
    }

    /**
     * Show the form for creating a new support staff.
     */
    public function create()
    {
        return view('admin.support.create');
    }

    /**
     * Store a newly created support staff in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'support',
        ]);

        return redirect()->route('admin.support.index')
            ->with('success', 'Support staff created successfully.');
    }

    /**
     * Display the specified support staff.
     */
    public function show(User $support)
    {
        // Ensure the user is support staff
        if ($support->role !== 'support') {
            abort(404);
        }

        return view('admin.support.show', compact('support'));
    }

    /**
     * Show the form for editing the specified support staff.
     */
    public function edit(User $support)
    {
        // Ensure the user is support staff
        if ($support->role !== 'support') {
            abort(404);
        }

        return view('admin.support.edit', compact('support'));
    }

    /**
     * Update the specified support staff in storage.
     */
    public function update(Request $request, User $support)
    {
        // Ensure the user is support staff
        if ($support->role !== 'support') {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $support->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $support->update($data);

        return redirect()->route('admin.support.index')
            ->with('success', 'Support staff updated successfully.');
    }

    /**
     * Remove the specified support staff from storage.
     */
    public function destroy(User $support)
    {
        // Ensure the user is support staff
        if ($support->role !== 'support') {
            abort(404);
        }

        $support->delete();

        return redirect()->route('admin.support.index')
            ->with('success', 'Support staff deleted successfully.');
    }
}
