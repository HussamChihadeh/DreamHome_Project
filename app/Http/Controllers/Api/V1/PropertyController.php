<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Models\User;
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
            $properties = Property::select('id', 'name', 'description', 'city', 'bedrooms', 'bathrooms', 'price', 'type','province', 'status', 'area', 'parking' , 'built_in', 'buy_or_rent', 'user_id')->where($queryItems)->paginate(15);
            return response()->json($properties->appends($request->query()));
        }
        
    }

    public function getLocation(){
        $properties = Property::where('status', 'listed')->select('id', 'longitude', 'latitude', 'buy_or_rent','city','name','description','province')->get();
        return response()->json($properties);
    }
    public function getLatestProperties(){
        $properties = Property::select('id','name','description')
                               ->latest()
                               ->limit(4)
                               ->get();
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
        if ($request->hasFile('propertyImages')) {
            $images = $request->file('propertyImages');
            $propertyFolderPath = public_path('images/properties/' . $property->id);
            if (!file_exists($propertyFolderPath)) {
                mkdir($propertyFolderPath, 0777, true);
            }
            $i = 1;
            foreach ($images as $image) {
                $fileName = $i . '.' . $image->getClientOriginalExtension();
                $image->move($propertyFolderPath, $fileName);
                $i++;
            }
        }
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
    public function updatePropertyStatus(Request $request, $id)
    {
        $property = Property::find($id);
        
        // Get the selected option
        $status = $request->input('accept-decline');
        
        // Update the status of the property
        $property->status = $status;
        $property->save();
        
        // Return a response
        return response()->json(['message' => 'Property status updated successfully.']);
    }

    public function assignProperty(Request $request, $id)
    {
        $property = Property::find($id);
        
        // Get the selected option
        $buyer_id = $request->input('buyer_id');

        $buyer = User::find($buyer_id);
        if (!$buyer) {
            return response()->json(['error' => 'Invalid customer ID.'], 400);
        }
        // Update the status of the property
        $property->buyer_id = $buyer_id;
        $property->status = "sold";
        $property->save();
        
        // Return a response
        return response()->json(['message' => 'Property status updated successfully.']);
    }
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
