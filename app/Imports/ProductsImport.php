<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'] ?? null,
            'category' => $row['category'] ?? 'General',
            'product_type' => $row['product_type'] ?? 'BOX',
            'brand' => $row['brand'] ?? null,
            'actual_price' => $row['actual_price'],
            'discounted_price' => $row['discounted_price'] ?? null,
            'unit' => $row['unit'] ?? null,
            'image' => $row['image'] ?? null,
            'content_per_container' => $row['content_per_container'] ?? null,
        ]);
    }
}
