<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Designer;
use App\Http\Requests\StoreDesignerRequest;
use App\Http\Requests\UpdateDesignerRequest;
use App\Http\Controllers\Controller;
use App\Models\Furniture;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class DesignerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designers = Designer::paginate(15);
        return response()->json($designers);
    }

    public function storeDesigner(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'age' => 'required',
            'experience' => 'required',
        ]);
        try {
            $designer = Designer::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'address' => $validatedData['address'],
                'age' => $validatedData['age'] ,
                'experience' => $validatedData['experience'],
            ]);
            // if ($request->hasFile('images')) {
            //     $images = $request->file('images');
            //     $furnitureItemFolderPath = public_path('images/designers/' . $furniture->id);
            //     if (!file_exists($furnitureItemFolderPath)) {
            //         mkdir($furnitureItemFolderPath, 0777, true);
            //     }
            //     $i = 1;
            //     foreach ($images as $image) {
            //         $fileName = $i . '.' . $image->getClientOriginalExtension();
            //         $image->move($furnitureItemFolderPath, $fileName);
            //         $i++;
            //     }
            // }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                // $designerId = $request->input('designer_id');
                $folderPath = public_path('images/designers');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $fileName = $designer->id . '.' . $image->getClientOriginalExtension();
                $image->move($folderPath, $fileName);
            }
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return response()->json(['errors' => $errors], 422);
        }
        // Return a success response
        return response()->json(['message' => 'Item saved successfully']);
    }

    public function showProfile()
    {
        $user = Auth::user();
        $designer = Designer::where('id', $user->id)->first();
        $furniture = Furniture::where('designer_id', $user->id)->get();

        $user_id= DB::table("ch_favorites")->where('user_id',$user->id)->pluck("favorite_id");
        $users="";
        if(!empty($user_id)){
            $users=User::whereIn('id',$user_id)->get();
        }
        return view('designer_profile', compact('designer', 'furniture','users'));

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
