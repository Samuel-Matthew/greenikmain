<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Solar Solutions',
                'description' => 'Solar panels, inverters, and complete solar energy systems',
            ],
            [
                'name' => 'Wind Power',
                'description' => 'Wind turbines and wind energy solutions',
            ],
            [
                'name' => 'Batteries',
                'description' => 'Energy storage systems and battery packs',
            ],
            [
                'name' => 'EV Chargers',
                'description' => 'Electric vehicle charging stations and accessories',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Various renewable energy accessories and components',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
