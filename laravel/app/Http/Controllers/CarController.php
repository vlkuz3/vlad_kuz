<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $cars = Car::all();
        // return view('cars.index', compact('cars'));
        $request->only([
            'brand',
            'model',
            'color',
            'year',
            'category_id',
            'price_per_day',
            'is_available'
        ]);

        $itemsPerPage = $request->input('itemsPerPage', 10);

        $cars = Car::filter($request)->paginate($itemsPerPage)->appends($request->query());
        $categories = CarCategory::all();
        return view('cars.index', compact('cars', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CarCategory::all();
        return view('cars.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'year' => 'required|digits:4|integer|min:1900',
            'category_id' => 'required|exists:car_categories,id',
            'price_per_day' => 'required|integer',
            'is_available' => 'required|boolean',
        ]);

        Car::create($data);
        return redirect()->route('cars.index')->with('success', 'Car added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $categories = CarCategory::all();
        return view('cars.edit', compact('car', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'year' => 'required|digits:4|integer|min:1900',
            'category_id' => 'required|exists:car_categories,id',
            'price_per_day' => 'required|decimal:2',
            'is_available' => 'required|boolean',
        ]);

        $car->update($request->all());
        return redirect()->route('cars.index')->with('success', 'Car data was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car was successfully deleted!');
    }
}
