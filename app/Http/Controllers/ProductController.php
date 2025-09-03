<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
        {
            return Product::select(
                'id', 'name', 'description', 'category', 'product_type',
                'brand', 'actual_price', 'discounted_price',
                'unit', 'image', 'content_per_container'
            )->get();
        }

    public function shopnow()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('shopnow', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
