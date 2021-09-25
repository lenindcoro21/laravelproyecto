<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([

            'name'=> 'Lenin Diaz',
            'email'=> 'lenincoro10@hotmail.com',
            'password'=> Hash::make('12345678'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        $user=User::create([

            'name'=> 'Eduardo Diaz',
            'email'=> 'lenindiaz1998@hotmail.com',
            'password'=> Hash::make('12345678'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
