<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductsApiController extends Controller
{
    public function index()
    {
        // Return all products (you can paginate later)
        return response()->json(
            Product::orderBy('category')->orderBy('name')->get()
        );
    }
}
