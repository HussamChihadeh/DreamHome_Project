<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Designer;
use App\Http\Requests\StoreDesignerRequest;
use App\Http\Requests\UpdateDesignerRequest;
use App\Http\Controllers\Controller;
use App\Models\Furniture;
use Illuminate\Support\Facades\Auth;

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

    public function showProfile()
    {
        $user = Auth::user();
        $designer = Designer::where('id', $user->id)->first();
        $furniture = Furniture::where('designer_id', $user->id)->get();
        return view('designer_profile', compact('designer', 'furniture'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignerRequest $request)
    {
        //
    }
    public function getDesigner_Details(){
        $designer = Designer::select('id', 'name')->get();
        return response()->json($designer);
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
