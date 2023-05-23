<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = ["usuario", "administrador"];
        
        foreach($roles as $rol){
            Rol::create([
                'name'=>$rol,
            ]);
        }
    }
}
