<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Tour;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with(['user:id,name', 'property:id,name'])
                    ->paginate(15);
        return response()->json($tours);
    }


    public function updateSlots(Request $request)
    {
        $bookedSlots = Tour::where('tour_date', $request->date)
                    ->where('property_id', $request->property_id) // add this to query by property_id
                    ->pluck('tour_time')
                    ->toArray();

    return response()->json(['bookedTimes' => $bookedSlots]);
    }

    public function requestTour(Request $request){
        try{
            $tour = new Tour;
            $tour->user_id = $request->input('user_id');
            $tour->property_id = $request->input('property_id');
            $tour->tour_date = $request->input('tour_date');
            $tour->tour_time = $request->input('tour_time');
            
            // set other attributes as needed
    
            // Step 5: Save the model
            $tour->save();
    
            // return a response or redirect to a success page
            return view("rent");
        } catch (QueryException $e) {
            // handle the error
            return response('Error: ' . $e->getMessage(), 500);
        }
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
    public function store(StoreTourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
