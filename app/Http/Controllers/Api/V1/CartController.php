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

    function getCartsByUserID() {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        
        $furnitureIds = $carts->pluck('furniture_id');
        $furniture = Furniture::whereIn('id', $furnitureIds)->get();
        
        return view('My_Cart', compact('carts', 'furniture'));
    }
    
    public function addToCart(Request $request){
        // $user=Auth::user();
        $furniture_id=$request->furniture_id;
        $user_id=$request->user_id;
        try{
            $cart=new Cart;
            $cart->user_id=$user_id;
            $cart->furniture_id=$furniture_id;
            $cart->quantity=1;
            $cart->save();
            return response()->json(['saved'=>$cart]); 
        }
        catch(QueryException $e){
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecartRequest $request, Cart $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $tour)
    {
        //
    }
}
