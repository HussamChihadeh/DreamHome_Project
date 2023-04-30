<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Request;
use App\Services\V1\PropertyQuery;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PropertyQuery();
        $queryItems = $filter->transform($request);
        if(count($queryItems)==0){
            $properties = Property::select('id', 'name', 'description', 'city', 'bedrooms', 'bathrooms', 'price', 'type','province', 'status', 'area', 'parking' , 'built_in', 'buy_or_rent')->paginate(15);
            return response()->json($properties);
        }
        else{
            $properties = Property::select('id', 'name', 'description', 'city', 'bedrooms', 'bathrooms', 'price', 'type','province', 'status', 'area', 'parking' , 'built_in', 'buy_or_rent')->where($queryItems)->paginate(15);
            return response()->json($properties->appends($request->query()));
        }
        
    }

    public function getLocation(){
        $properties = Property::select('id', 'longitude', 'latitude', 'buy_or_rent')->get();
        return response()->json($properties);
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
    public function store(StorePropertyRequest $request)
    {
        //
        // return Property::create($request->all());
    }

    public function sell(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email|max:255',
        //     // add more validation rules as needed
        // ]);

        // Step 4: Create a new instance of the model
        try{
        $property = new Property;
        $property->name = $request->input('name');
        $property->price = $request->input('price');
        $property->user_id = $request->input('user_id');
        $property->description = $request->input('description');
        $property->bedrooms = $request->input('bedrooms');
        $property->bathrooms = $request->input('bathrooms');
        $property->status = $request->input('status');
        $property->parking = $request->input('parking');
        $property->type = $request->input('type');
        $property->buy_or_rent = $request->input('buy_or_rent');
        $property->built_in = $request->input('built_in');
        $property->area = $request->input('area');
        $property->latitude = $request->input('latitude');
        $property->longitude = $request->input('longitude');
        $property->province = $request->input('province');
        $property->city = $request->input('city');
        $property->street = $request->input('street');

        
        // set other attributes as needed

        // Step 5: Save the model
        $property->save();

        // return a response or redirect to a success page
        return view("rent");
    } catch (QueryException $e) {
        // handle the error
        return response('Error: ' . $e->getMessage(), 500);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
        $property = Property::find($property->id);
        return response()->json($property);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
