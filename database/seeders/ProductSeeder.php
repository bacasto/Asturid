<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagesProducts = [
            'https://img.freepik.com/foto-gratis/ensalada-pollo-verduras-aceitunas_1220-4069.jpg?w=900&t=st=1684861526~exp=1684862126~hmac=1fa55a5d393d023a7ac5d3ee52a0265fdfbc29e35cda635d122783e441fb6afa',
            'https://img.freepik.com/foto-gratis/primer-tiro-pasta-penne-tomate_181624-42934.jpg?w=900&t=st=1684861529~exp=1684862129~hmac=b706a60fcb6b5b3df774ca5aa0a54554d9740501c821fe629ef84f984ca159e9',
            'https://img.freepik.com/foto-gratis/bebida-cola-fresca-vidrio_144627-16201.jpg?w=740&t=st=1684861543~exp=1684862143~hmac=0f7703280077e05e1d5ff54ccb8098aa63a3dc12ac9e8627eb931ceaee6b697f'
        ];
        foreach (range(0,10) as $product){
            $categoryRandom = Category::inRandomOrder()->first();
            $imageRandom = $imagesProducts[array_rand($imagesProducts)];
            Product::create([
                'name'=>'Product_'.$product,
                'description'=>'Description_'.$product,
                'stock'=>($product+3)*2,
                'category_id'=>$categoryRandom->id,
                'image'=>$imageRandom,
                'price'=>(10+$product)*1.55,
                'showProduct'=> $product%2==0 ? 0 : 1, //0-1
            ]);
        }
    }
}
