<?php

namespace App\Http\Controllers\Api\V1;

// use App\Http\Requests\UpdatecartRequest;
use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
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

    
    
    public function checkout()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;

            Cart::where('user_id', $user_id)->update(['checkout' => 'yes']);

            // Optionally, you can return a response if needed
            return response()->json(['message' => 'Checkout successful']);
        } else {
            // User is not authenticated, handle accordingly
            return response()->json(['message' => 'User is not authenticated'], 401);
        }
    }
    

    public function addToCart(Request $request)
    {
        $furniture_id = $request->furniture_id;
        $user_id = $request->user_id;

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
