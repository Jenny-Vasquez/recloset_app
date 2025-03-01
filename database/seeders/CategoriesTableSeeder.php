<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Ropa']);
        Category::create(['name' => 'Calzado']);
        Category::create(['name' => 'Bolsos']);
        Category::create(['name' => 'Accesorios']);
        Category::create(['name' => 'Tecnología']);
        Category::create(['name' => 'Tecnología']);
        Category::create(['name' => 'Deporte']);
        Category::create(['name' => 'Libros']);
        Category::create(['name' => 'Otros']);
    }
}
