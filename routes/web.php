<?php

use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\TourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [HomeController::class, "index"])->name("home.index");
// Route::get('/rent', [HomeController::class, "rent"])->name("home.rent");
// Route::get('/sell', [HomeController::class, "sell"])->name("home.sell");
// Route::get('/login', [HomeController::class, "login"])->name("home.login");
// Route::get('/furniture', [HomeController::class, "furniture"])->name("home.furniture");



    Route::get("/", function(){
        return view("home");
    })->name('home');
    Route::get("/rent", function(){
        return view("rent");
    })->name('rent');
    Route::get("/sell", function(){
        return view("sell");
    })->name('sell');
    Route::get("/furniture", function(){
        return view("furniture");
    })->name('furniture');
    Route::get("/furniture/furniture_details", function(){
        return view("furniture_details");
    });

    Route::get('/rent/Property_details', function () {
        return view('Property_details');
    });
    
    

    Route::get("/contact_designer", function(){
        return view("designers");
    })->name('contact_designer');

    
    Route::get("/signin", function(){
        return view("logIn");
    });

    Route::get("/admin_assign", function(){
        return view("Admin_Assign");
    });

    

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [UserController::class, 'login'])->name('login');
        Route::post('/login', [UserController::class, 'authenticate'])->name('login');
        Route::get("/signup", function(){
            return view("signup");
        })->name('signup');
        
        
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::delete('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
        Route::get('/sell', function () {
            return view('sell');
        })->name("sell");
        Route::post('/sell', [PropertyController::class, 'sell'])->name('sell');
        Route::post('/request_tour', [TourController::class, 'requestTour'])->name('request_tour1');
        // Route::get('/property/request_tour', function () {
        //     return view('request_tour');
        // });
        Route::get('/rent/request_tour', function () {
            return view('request_tour');
        });
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {
        // routes that only the admin should access
        Route::get("/admin_customers", function(){
            return view("Admin_Customers");
        })->name("customers");
    
        Route::get("/admin_requests", function(){
            return view("Admin_Requests");
        })->name("requests");
    
    
        Route::get("/admin_assign", function(){
            return view("Admin_Assign");
        })->name("assign");

        Route::get("/admin_furniture", function(){
            return view("Admin_Furniture");
        })->name("admin_furniture");
    });