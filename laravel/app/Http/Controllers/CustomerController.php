<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $customers = Customer::all();
        // return view('customers.index', compact('customers'));

        $request->only([
            'name',
            'email',
            'phone',
        ]);

        $itemsPerPage = $request->input('itemsPerPage', 10);
        $customers = Customer::filter($request)->paginate($itemsPerPage)->appends($request->query());
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|unique:customers',
        ]);

        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string',
        ]);

        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }
}
