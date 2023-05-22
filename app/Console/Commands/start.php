<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use App\Models\User;

class start extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rolesExisten = Rol::all();
        if(count($rolesExisten)==0){
        $roles = ["usuario", "administrador"];

        foreach($roles as $rol){
            Rol::create([
                'name'=>$rol,
            ]);
        }

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
        return 0;
    }
}
