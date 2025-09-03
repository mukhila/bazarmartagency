<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
{
    // Handle order submission
    // Send email to site owner
    // Save to database
    return response()->json(['message' => 'Order received successfully']);
}
}
