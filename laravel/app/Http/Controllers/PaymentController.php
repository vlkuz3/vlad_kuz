<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $payments = Payment::with('rental')->get();
        // return view('payments.index', compact('payments'));

        $request->only([
            'rental_id',
            'amount',
            'status',
            'payment_date',
        ]);

        $itemsPerPage = $request->input('itemsPerPage', 10);

        $payments = Payment::filter($request)->paginate($itemsPerPage)->appends($request->query());
        $rentals = Rental::all();
        return view('payments.index', compact('payments', 'rentals'));
    }

    public function create()
    {
        $rentals = Rental::all();
        return view('payments.create', compact('rentals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid,pending',
            'payment_date' => 'required|date',
        ]);
        Payment::create($validated);
        return redirect()->route('payments.index')->with('success', 'Payment recorded.');
    }

    public function edit(Payment $payment)
    {
        $rentals = Rental::all();
        return view('payments.edit', compact('payment', 'rentals'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid,pending',
            'payment_date' => 'required|date',
        ]);
        $payment->update($validated);
        return redirect()->route('payments.index')->with('success', 'Payment updated.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted.');
    }
}
