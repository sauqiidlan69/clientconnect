<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'id_number' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'notes' => 'nullable',
        ]);

        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'id_number' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'notes' => 'nullable',
        ]);

        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }
}
