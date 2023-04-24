<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Designer;
use App\Http\Requests\StoreDesignerRequest;
use App\Http\Requests\UpdateDesignerRequest;
use App\Http\Controllers\Controller;

class DesignerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designers = Designer::all();
        return response()->json($designers);
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Designer $designer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designer $designer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignerRequest $request, Designer $designer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designer $designer)
    {
        //
    }
}
