<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\Cart;
use App\Models\Furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{


    function getCartsByUserID()
    {
        $user = auth()->user();
        $userId = $user->id;
        $userName = $user->name;

        return view('Checkout', compact('userId', 'userName'));
    }


    
}
