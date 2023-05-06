<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Http\Requests\StorecartRequest;
use App\Http\Requests\UpdatecartRequest;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorecartRequest $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // get the current user's cart
        $cart = Auth::user()->cart;

        // check if the item already exists in the cart
        $item = $cart->items()->where('product_id', $validatedData['product_id'])->first();

        if ($item) {
            // update the quantity of the existing item
            $item->update(['quantity' => $item->quantity + $validatedData['quantity']]);
        } else {
            // add a new item to the cart
            $cart->items()->create([
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity']
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecartRequest $request, cart $cart)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // update the quantity of the cart item
        $cart->update(['quantity' => $validatedData['quantity']]);

        return redirect()->back()->with('success', 'Cart item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        $cart->delete();

        return redirect()->back()->with('success', 'Cart item deleted successfully.');
    }
}
