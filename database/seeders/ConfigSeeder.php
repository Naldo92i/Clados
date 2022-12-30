<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            [
                'name' => 'Sodia',
                'name' => '70000000',
                'code' => '226',
                'address' => 'Ouagadougou, 1200 Logements',
            ]
        ];

        foreach ($configs as $config){
            $about = \App\Models\Config::create($config);
        }
    }
}
