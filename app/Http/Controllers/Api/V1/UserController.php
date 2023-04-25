<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Validation\ValidationException;

use App\Models\User;
// use App\Http\Requests\StoreCustomerRequest;
// use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                return redirect('/admin_assign')->with('success', 'Login Success');
            } else {
                return redirect('/')->with('success', 'Login Success');
            }
        }
 
        return back()->with('error', 'Error Email or Password');
    } 

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }   

    // public function dashboard()
    // {
    //     if(Auth::check())
    //     {
    //         return view('auth.dashboard');
    //     }
        
    //     return redirect()->route('login')
    //         ->withErrors([
    //         'email' => 'Please login to access the dashboard.',
    //     ])->onlyInput('email');
    // } 
    public function showProfile()
    {
        $user = Auth::user();
        $ownedProperties = $user->properties;
        $boughtProperties = $user->boughtProperties;
        return view('profile', compact('ownedProperties', 'boughtProperties'));
        // return view('profile', compact('properties'));
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
