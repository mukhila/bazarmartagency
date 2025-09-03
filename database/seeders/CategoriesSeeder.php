<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create([
            'name' => 'SPARKLERS',
            'description' => 'Category 1: Sparklers',
            'image' => 'sparklers.jpg',
        ]);

        \App\Models\Category::create([
            'name' => 'FLOWER POTS',
            'description' => 'Category 2: Flower Pots',
            'image' => 'flower_pots.jpg',
        ]);

        \App\Models\Category::create([
            'name' => 'NEW ATTRACTION FLOWERPOTS',
            'description' => 'Category 3: New Attraction Flowerpots',
            'image' => 'new_attraction_flowerpots.jpg',
        ]);

        \App\Models\Category::create([
            'name' => 'GROUND CHAKKAR',
            'description' => 'Category 4: Ground Chakkar',
            'image' => 'ground_chakkar.jpg',
        ]);

        \App\Models\Category::create([
            'name' => 'KIDS WHEEL',
            'description' => 'Category 5: Kids Wheel',
            'image' => 'kids_wheel.jpg',
        ]);
    }
}
