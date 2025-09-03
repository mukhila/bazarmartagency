<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Mail\OrderSubmitted;

class OrderApiController extends Controller
{
     public function store(Request $request)
    {
        $data = $request->validate([
            'customer.name' => 'required|string|max:120',
            'customer.phone' => 'required|string|max:30',
            'customer.address' => 'required|string|max:500',
            'customer.email' => 'nullable|email',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'totals.total_products' => 'required|integer|min:1',
            'totals.total_amount' => 'required|numeric|min:0',
            'totals.total_savings' => 'required|numeric|min:0',
            'order_date' => 'nullable|date'
        ]);

        $min = (int)(env('MIN_ORDER_TOTAL', 3000));
        if ($data['totals']['total_amount'] < $min) {
            return response()->json([
                'message' => "Minimum order amount is ₹{$min}"
            ], 422);
        }

        // (Optional) Recalculate to prevent tampering
        $recalc = 0;
        foreach ($data['items'] as $item) {
            $p = Product::find($item['product_id']);
            $price = (float)($p->discounted_price ?? $p->actual_price);
            $recalc += $price * (int)$item['quantity'];
        }
        if (round($recalc, 2) !== round($data['totals']['total_amount'], 2)) {
            return response()->json(['message' => 'Total mismatch'], 422);
        }

        // Email site owner
        $to = env('SITE_OWNER_EMAIL', 'sales@bazar-mart.in');
        Mail::to($to)->send(new OrderSubmitted($data));

        // You can also persist in DB (orders, order_items). Skipping for brevity.

        return response()->json(['status' => 'ok']);
    }
}
