<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $rentals = Rental::with('car', 'customer')->get();
        // return view('rentals.index', compact('rentals'));

        $request->only([
            'car_id',
            'customer_id',
            'start_date',
            'end_date',
            'total_price',
        ]);

        $itemsPerPage = $request->input('itemsPerPage', 10);
        $rentals = Rental::filter($request)->paginate($itemsPerPage)->appends($request->query());
        $cars = Car::all();
        $customers = Customer::all();
        return view('rentals.index', compact('rentals', 'cars', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::where('is_available', true)->get();
        $customers = Customer::all();
        return view('rentals.create', compact('cars', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($validated['car_id']);
        $days = (new \DateTime($validated['start_date']))->diff(new \DateTime($validated['end_date']))->days;
        $total_price = $car->price_per_day * $days;

        $rental = Rental::create([
            ...$validated,
            'total_price' => $total_price,
        ]);

        $car->update(['is_available' => false]);

        return redirect()->route('rentals.index')->with('success', 'Rental created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        $cars = Car::all();
        $customers = Customer::all();
        return view('rentals.edit', compact('rental', 'cars', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $days = (new \DateTime($validated['start_date']))->diff(new \DateTime($validated['end_date']))->days;
        $total_price = $rental->car->price_per_day * $days;

        $rental->update([
            ...$validated,
            'total_price' => $total_price,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        $rental->car->update(['is_available' => true]);
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Rental deleted.');
    }
}
