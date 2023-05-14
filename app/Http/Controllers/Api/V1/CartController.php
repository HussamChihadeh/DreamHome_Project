<?php

namespace App\Http\Controllers\Api\V1;

// use App\Http\Requests\UpdatecartRequest;
use App\Jobs\DecreaseAndReaddFurnitureJob;
use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
use App\Models\Furniture;




// use Illuminate\Support\Facades\Auth;

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
    public function store(StoreCartRequest $request)
    {
        //
    }
    function getCartsByUserID()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $carts = Cart::where('user_id', $user_id)
            ->where('checkout', 'no')
            ->get();

        $furnitureIds = $carts->pluck('furniture_id');
        $furniture = Furniture::whereIn('id', $furnitureIds)->get();

        return view('My_Cart', compact('user', 'carts', 'furniture'));
    }



    public function updateCart(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        // Find the cart item
        $cart = Cart::find($id);

        if (!$cart) {
            // Cart item not found
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        // Find the corresponding furniture
        $furniture = Furniture::find($cart->furniture_id);

        if (!$furniture) {
            // Furniture not found
            return response()->json(['message' => 'Furniture not found'], 404);
        }

        if ($quantity > $furniture->quantity) {
            // New quantity is greater than available quantity
            return response()->json(['message' => 'Insufficient quantity'], 400);
        }

        // Update the cart with the new quantity
        $cart->quantity = $quantity;
        $cart->save();

        // Return a response indicating success
        return response()->json(['message' => 'Cart updated successfully']);
    }

    // CartController.php (or your relevant controller)

    public function destroy($id)
    {
        // Find the cart item by ID and delete it
        $cart = Cart::findOrFail($id);
        $cart->delete();

        // Optionally, you can perform additional actions after deleting the cart item

        // Return a response indicating the success of the operation
        return response()->json(['message' => 'Cart item deleted successfully']);
    }



    public function checkout(Request $request)
    {
        $user_id = $request->user_id;
    
        // Retrieve the cart items for the user
        $cartItems = Cart::where('user_id', $user_id)->get();
    
        // Decrease the quantity of furniture based on the cart items
        foreach ($cartItems as $cartItem) {
            $furniture = Furniture::find($cartItem->furniture_id);
            $newQuantity = $furniture->quantity - $cartItem->quantity;
            
            // Make sure the quantity doesn't go below zero
            if ($newQuantity >= 0) {
                $furniture->quantity = $newQuantity;
                $furniture->save();
            }
        }
    
        // Delete the cart items for the user
        Cart::where('user_id', $user_id)->delete();
    
        // Optionally, you can return a response if needed
        return response()->json(['message' => 'Checkout successful']);
    }
    



    // public function reviewCartQuantitiesAjax()
    // {
    //     // Call the reviewCartQuantities function
    //     $this->reviewCartQuantities();

    //     // Optionally, you can return a response
    //     return response()->json(['message' => 'Cart quantities reviewed successfully']);
    // }

    function reviewCartQuantities()
    {
        // Retrieve all the carts
        $carts = Cart::all();

        foreach ($carts as $cart) {
            // Retrieve the associated furniture
            $furniture = Furniture::find($cart->furniture_id);

            if ($furniture && $cart->quantity > $furniture->quantity) {
                // Adjust the cart quantity to match the available furniture quantity
                $cart->quantity = $furniture->quantity;
                $cart->save();
            }
        }
        return response()->json(['message' => 'Revision successful']);
    }

    public function addToCart(Request $request)
    {
        $furniture_id = $request->furniture_id;
        $user_id = $request->user_id;


        // Bus::dispatch(new DecreaseAndReaddFurnitureJob($furniture_id))->delay(now()->addMinutes(1));
        try {
            $cart = Cart::where('furniture_id', $furniture_id)
                ->where('user_id', $user_id)
                ->first();

            if ($cart) {
                // If the combination already exists, increase the quantity by 1
                $cart->quantity += 1;
                $cart->save();
            } else {
                // If the combination doesn't exist, create a new cart entry
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->furniture_id = $furniture_id;
                $cart->quantity = 1;
                $cart->save();
            }

            return response()->json(['saved' => $cart]);
        } catch (QueryException $e) {
            return response($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $tour)
    {
        //

    }

    // setTimeout(function() {
    //     increaseQuantity(furnitureId);
    //   }, 15 * 60 * 1000); 


    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
}
