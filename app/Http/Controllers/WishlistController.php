<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use App\Http\Requests\StorewishlistRequest;
use App\Http\Requests\UpdatewishlistRequest;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorewishlistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatewishlistRequest $request, wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(wishlist $wishlist)
    {
        //
    }
}
