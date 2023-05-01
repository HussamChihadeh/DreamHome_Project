<?php

namespace App\Http\Controllers\Api\V1;

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
            $furniture = Furniture::select('id', 'name','price', 'style', 'material', 'designer_id', 'date', 'place', 'quantity')->paginate(15);
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
    public function store(StoreFurnitureRequest $request)
    {
        //
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
