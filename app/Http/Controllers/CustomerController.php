<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display all customers
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    // Display add customer form
    public function create()
    {
        return view('customers.create');
    }

    // Save new customer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|min:3|max:100',
            'email'     => 'required|email|max:100',
            'phone'     => 'nullable|max:20',
        ]);

        Customer::create([
            'full_name'  => $validated['full_name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'] ?? null,
            'created_at' => now(),
        ]);

        return redirect('/customers')
            ->with('success', 'Customer added successfully.');
    }

    // Display edit customer form
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    // Update customer
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|min:3|max:100',
            'email'     => 'required|email|max:100',
            'phone'     => 'nullable|max:20',
        ]);

        $customer->update([
            'full_name' => $validated['full_name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'] ?? null,
        ]);

        return redirect('/customers')
            ->with('success', 'Customer updated successfully.');
    }

    // Delete customer
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect('/customers')
            ->with('success', 'Customer removed successfully.');
    }
}
