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
        if (count($queryItems) == 0) {
            $furniture = Furniture::select('id', 'name', 'price', 'style', 'type', 'material', 'designer_id', 'date', 'place', 'quantity', 'description')->paginate(15);
            return response()->json($furniture);
        } else {
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
                'place' => $validatedData['place'],
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

        $folderPath = public_path('images/furniture/' . $furniture->id);

        // Get the list of image file names in the folder
        $imageNames = collect(scandir($folderPath))
            ->reject(function ($name) {
                return in_array($name, ['.', '..']);
            });

        $furniture->image_names = $imageNames;
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


    // public function getRecommendedProducts(Request $request)
    // {
    //     $furniture = Furniture::findOrFail($request->id);
    //     $designer = $furniture->designer_id;
    //     $type = $furniture->type;
    //     $style = $furniture->style;

    //     $recommendedByDesigner = Furniture::where('designer_id', $designer)
    //                                         ->where('id', '!=', $request->id)
    //                                         ->take(1)->get();

    //     $recommendedByType = Furniture::where('type', $type)
    //                                         ->where('id', '!=', $request->id)
    //                                         ->take(1)->get();

    //     $recommendedByStyle = Furniture::where('style', $style)
    //                                         ->where('id', '!=', $request->id)
    //                                         ->take(1)->get();

    //     $recommendedProducts = $recommendedByDesigner->merge($recommendedByType)->merge($recommendedByStyle);

    //     return response()->json([
    //         'furniture' => $furniture,
    //         'recommendedProducts' => $recommendedProducts,
    //     ]);
    // }
    public function getRecommendedProducts(Request $request)
    {
        $furniture = Furniture::findOrFail($request->id);

        // Get all furniture items with a different ID
        $otherFurniture = Furniture::where('id', '!=', $request->id)->get();

        // Calculate the Jaccard similarity coefficient for each item
        $similarities = $otherFurniture->map(function ($other) use ($furniture) {
            $featuresA = collect([
                $furniture->type,
                $furniture->style,
                $furniture->designer_id,
                // add more features as needed
            ])->filter(function ($value) {
                return !empty($value);
            })->toArray();

            $featuresB = collect([
                $other->type,
                $other->style,
                $other->designer_id,
                // add more features as needed
            ])->filter(function ($value) {
                return !empty($value);
            })->toArray();

            $intersection = count(array_intersect($featuresA, $featuresB));
            $union = count(array_unique(array_merge($featuresA, $featuresB)));

            return [
                'id' => $other->id,
                'similarity' => $union == 0 ? 0 : $intersection / $union,
            ];
        });

        // Sort the furniture items by their similarity to the target item
        $sortedFurniture = $similarities->sortByDesc('similarity');

        // Get the top 3 most similar items
        $recommendedProducts = $sortedFurniture->take(4)->map(function ($item) {
            return Furniture::findOrFail($item['id']);
        });

        return response()->json([
            'furniture' => $furniture,
            'recommendedProducts' => $recommendedProducts,
        ]);
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




    public function updateFurn(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;

        // Find the cart item
        $furn = Furniture::find($id);
        $furn->quantity = $quantity;
        $furn->save();
        return response()->json(['message' => ' updated successfully']);


    }
}
