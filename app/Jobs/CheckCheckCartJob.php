<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\Furniture;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CheckCheckCartJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $furniture_id = $this->furniture_id;
    
        // Retrieve the furniture
        $furniture = Furniture::find($furniture_id);
    
        if ($furniture) {
            // Retrieve the user's cart
            $user = Auth::user();
            $carts = Cart::where('user_id', $user->id)->get();
    
            // If the cart is empty, re-increase the furniture quantity
            if ($carts->isEmpty()) {
                $furniture->quantity += 1;
                $furniture->save();
            }
        }
    }
    
}
