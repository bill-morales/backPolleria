<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\platillo;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::factory(5)->create()->each(function ($category) {
            // Para cada categoría, crear 5 subcategorías
            $category->subcategories()->saveMany(Subcategory::factory(5)->make())
                ->each(function ($subcategory) {
                    // Para cada subcategoría, crear 3 productos
                    $subcategory->platillos()->saveMany(platillo::factory(10)->make());
                });
        });
    }
}
