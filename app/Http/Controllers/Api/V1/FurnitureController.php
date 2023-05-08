<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Designer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\Furniture;
use App\Http\Requests\StoreFurnitureRequest;
use App\Http\Requests\UpdateFurnitureRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Services\V1\FurnitureQuery;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new FurnitureQuery();
        $queryItems = $filter->transform($request);
        if(count($queryItems)==0){
            $furniture = Furniture::select('id', 'name','price', 'style', 'type','material', 'designer_id', 'date', 'place', 'quantity', 'description')->paginate(15);
            return response()->json($furniture);
        }
        else{
            $furniture = Furniture::where($queryItems)->paginate(15);
            return response()->json($furniture->appends($request->query()));
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
    public function storeItem(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'style' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'material' => 'required|string',
            'place' => 'required|string',
            'date' => 'required',
            'price' => 'required',
            'designer_id' => 'required', Rule::exists('designers', 'id'),
            'quantity' => 'required',
        ]);
        $designer = Designer::find($validatedData['designer_id']);
        if (!$designer) {
            return response()->json(['errors' => ['designer_id' => 'The selected designer id is invalid']], 422);
        }
        try {
            $designer = Designer::findOrFail($validatedData['designer_id']);
            $furniture = Furniture::create([
                'name' => $validatedData['name'],
                'style' => $validatedData['style'],
                'type' => $validatedData['type'],
                'description' => $validatedData['description'],
                'material' => $validatedData['material'],
                'place' => $validatedData['place'] ,
                'date' => $validatedData['date'],
                'price' => $validatedData['price'],
                'designer_id' => $validatedData['designer_id'],
                'quantity' => $validatedData['quantity'],
            ]);
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $furnitureItemFolderPath = public_path('images/furniture/' . $furniture->id);
                if (!file_exists($furnitureItemFolderPath)) {
                    mkdir($furnitureItemFolderPath, 0777, true);
                }
                $i = 1;
                foreach ($images as $image) {
                    $fileName = $i . '.' . $image->getClientOriginalExtension();
                    $image->move($furnitureItemFolderPath, $fileName);
                    $i++;
                }
            }
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errors->add('designer_id', 'The selected designer id is invalid');
            return response()->json(['errors' => $errors], 422);
        }
        // Return a success response
        return response()->json(['message' => 'Item saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Furniture $furniture)
    {
        //
        $furniture = Furniture::find($furniture->id);
        $furniture->designer_name = $furniture->designers->name;
        return response()->json($furniture);
    }

    public function filterData()
    {
        $designers = Designer::select('id', 'name')->get();
        $types = Furniture::distinct()->pluck('type');
        $styles = Furniture::distinct()->pluck('style');

        $data = [
            ['type' => 'designers', 'data' => $designers],
            ['type' => 'types', 'data' => $types],
            ['type' => 'styles', 'data' => $styles],
        ];
        
        return response()->json(compact('data'));
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Furniture $furniture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFurnitureRequest $request, Furniture $furniture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Furniture $furniture)
    {
        //
    }
}
