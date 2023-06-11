<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Seeder;

class OrderStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ["Pagado","Pendiente","En proceso","Enviado","Completado"];
        foreach ($states as $state){
            OrderState::create([
                'state'=>$state
            ]);
        }

    }
}
