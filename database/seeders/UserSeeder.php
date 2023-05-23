<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin_id = Rol::select('id')->where('name','administrador')->first();

        User::create([
            'rol_id'=>$admin_id->id,
            'name'=> 'Administrador',
            'address'=>'casa del admin',
            'phone'=>"66612345",
            'zip'=> "11111",
            'email'=> "admin@admin.com",
            'password'=>Hash::make("password")
        ]);
    }
}
