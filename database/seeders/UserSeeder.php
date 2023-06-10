<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_id = Rol::select('id')->where('name', 'administrador')->first();
        User::create([
            'rol_id' => $admin_id->id,
            'name' => "Administrador",
            'phone' => "66612345",
            'zip' => "11111",
            'email' => "admin@admin.es",
            'address' => "Direccion x",
            'password' => Hash::make("password"),
        ]);
    }
}
