<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['bebidas', 'pizzas', 'paste', 'ensaladas', 'entrantes', 'sopas', 'carne', 'pescado', 'postres'];
        foreach($categories as $cat){
            Category::create([
                'name'=>$cat
            ]);
        }
    }
}
