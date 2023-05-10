<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Designer;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use App\Models\User;
// use App\Http\Requests\StoreCustomerRequest;
// use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except([
    //         'logout', 'dashboard'
    //     ]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(15);
        return response()->json($users);
    }

    public function getCustomersCount()
    {
        $count = User::count();
        return response()->json(['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     */

    //done
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'address' => 'string|max:250',
            'phone_number' => 'required|string|max:250',
        ]);

        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'address' => $validatedData['address'] ?? null,
                'phone_number' => $validatedData['phone_number'] ?? null,
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        return response()->json($user, 201);
    }

    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->email === 'admin@dreamhome.org') {
                return redirect('/admin_customers')->with('success', 'Login Success');
            } 
            elseif (strpos($user->email, '@Designer.org') !== false) {
                // Code for @designer.org domain
                // Add your desired logic here
                // For example, you can redirect to a different route or perform additional actions
                return redirect('/chatify')->with('success', 'Login Success for Designer');
            } 
            else {
                // return redirect('/')->with('success', 'Login Success');
                return redirect()->intended('/')->with('success', 'Login Success');
            }
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }


    public function showProfile()
    {
        $user = Auth::user();
        $designers="";
        $ownedProperties = $user->properties;
        $boughtProperties = $user->boughtProperties;
        $favoriteId = DB::table('ch_favorites')
                   ->where('user_id', $user->id)
                   ->pluck('favorite_id');

        if(!empty($favoriteId)){
            $designers = Designer::whereIn('id', $favoriteId)->get();
        }
        return view('profile', compact('ownedProperties', 'boughtProperties', 'designers'));

        
    }

    public function getWishlist(Request $request)
    {
        $user = User::find($request->id);
        $wishlist = json_decode($user->wishlist, true) ?? [];
        return response()->json($wishlist);
    }


    public function addToWishlist(Request $request)
    {
        $user = User::find($request->id);
        $wishlistData = json_decode($user->wishlist, true) ?? [];
        $itemIndex = array_search($request->item, $wishlistData);
        if ($itemIndex !== false) {
            unset($wishlistData[$itemIndex]);
        } else {
            $wishlistData[] = $request->item;
        }
        $user->wishlist = json_encode(array_values($wishlistData));
        $user->save();
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateCustomerRequest $request, Customer $customer)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
