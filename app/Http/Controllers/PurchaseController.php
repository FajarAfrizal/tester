<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $purchase = Purchase::all();
        return view('purchase.purchase', compact('product', 'purchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_purchase' => 'required',
            'products' => 'required|array',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number
        ]);

        $purchase = Purchase::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $customer->id,
            'date'=> now(),
            'total_purchase' => $request->total_purchase,
        ]);

        foreach ($request->products as $product) {
            $purchase->products()->attach($product['product_id'],[
                    'quantity' => $product['quantity'],
                    'total_price' => $product['total_price'],
                    'price' => $product['price'],
                ]);
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase, $id)
    {
        Purchase::findOrFail($id)->delete();
        return redirect()->back();
    }
}
