<?php

namespace App\Jobs;
use App\Models\Furniture;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class DecreaseAndReaddFurnitureJob implements ShouldQueue
{
    public $furniture_id;

    public function __construct($furniture_id)
    {
        $this->furniture_id = $furniture_id;
    }

    public function handle()
    {
        $furniture_id = $this->furniture_id;
    
        // Retrieve the furniture
        $furniture = Furniture::find($furniture_id);
    
        if ($furniture) {
            // Decrease the furniture quantity by 1
            $furniture->quantity -= 1;
            $furniture->save();
    
            // Schedule the job to check the cart after 10 minutes
            CheckCheckCartJob::dispatch($furniture_id)->delay(now()->addMinutes(1));
        }
    }
    
}