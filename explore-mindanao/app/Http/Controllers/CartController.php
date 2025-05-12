<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // For now, return a simple view for the cart page
        return view('cart');
    }
}
