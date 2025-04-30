<?php

namespace App\Http\Controllers;

use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CarCategory::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:car_categories,name',
        ]);

        CarCategory::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    public function edit(CarCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, CarCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:car_categories,name,' . $category->id,
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(CarCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}
