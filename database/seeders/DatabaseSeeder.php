<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(15)->create()->each(function (Category $category) {
            $Subcategories = Subcategory::factory(5)->create()-> each(function (Subcategory $subcategory) {
                $product = Product::factory(20)->create();
            });
        });
    }
}
