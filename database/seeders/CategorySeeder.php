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
        $categories = [
            'Bebidas','Pizzas','Pasta',
            'Ensaldas','Entrantes','Sopas',
            'Carne','Pestado','Postres'
        ];
        foreach($categories as $cat){
            Category::create([
                'name'=>$cat
            ]);
        }
    }
}
