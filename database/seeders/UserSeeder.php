<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname'=>'BALBONE',
                'lastname'=>'WAHABOU',
                'telephone'=>'56002703',
                'email'=>'admin@admin.com',
                'password'=> Hash::make('password'),
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($users as $user){
            $user = \App\Models\User::create($user);
            $user->attachRole('super-administrateur');
        }
    }
}
