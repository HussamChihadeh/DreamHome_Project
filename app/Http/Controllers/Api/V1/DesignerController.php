<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Designer;
use App\Http\Requests\StoreDesignerRequest;
use App\Http\Requests\UpdateDesignerRequest;
use App\Http\Controllers\Controller;
use App\Models\Furniture;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Symfony\Component\HttpFoundation\Request;

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
            'bio' => 'required',
            'linkedin' => 'required',
        ]);
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => strtolower(str_replace(' ', '', $validatedData['name'])) . '@Designer.org',
                'password' => Hash::make("12345678"),
                'address' => $validatedData['address'] ?? null,
                'phone_number' => $validatedData['phone_number'] ?? null,
            ]);

            $designer = Designer::create([
                'id' => $user->id, 
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'address' => $validatedData['address'],
                'age' => $validatedData['age'] ,
                'experience' => $validatedData['experience'],
                'bio' => $validatedData['bio'],
                'linkedin' => $validatedData['linkedin'],
            ]);
         
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                // $designerId = $request->input('designer_id');
                $folderPath = public_path('images/designers');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $fileName = $user->id . '.' . $image->getClientOriginalExtension();
                $image->move($folderPath, $fileName);
            }
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return response()->json(['errors' => $errors], 422);
        }
        // Return a success response
        return response()->json(['message' => 'Item saved successfully']);
    }

    public function deleteDesigner($id)
    {
        try {
            // Find the designer by ID
            $designer = Designer::findOrFail($id);
            
            // Delete the associated user
            $user = User::findOrFail($id);
            $user->delete();
            
            // Delete the designer's image folder
            $imagePath = public_path('images/designers/' . $id . '.png');
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            // Delete the designer
            $designer->delete();
        } catch (ModelNotFoundException $e) {
            // Return an error response if the designer was not found
            return response()->json(['error' => 'Designer not found'], 404);
        }
        
        // Return a success response
        return response()->json(['message' => 'Designer deleted successfully']);
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

    public function showAllDesignerDetails(Request $request)
    {
        $designer_id = $request->input('designer_id');
    
        $User = User::where('id',$designer_id)->get();
    
      
        return view('My_Cart', compact('user'));

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
    
}
