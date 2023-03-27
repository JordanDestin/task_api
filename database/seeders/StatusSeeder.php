<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Statutes;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statutes =[
            [
                'name'=>'A faire'    
            ],
            [
                'name'=>'En cours'                
            ],
            [
                'name'=>'En attente'                
            ],
            [
                'name'=>'Résolu'                
            ]
        ];

        foreach ($statutes as $key => $value) {
            Statutes::create($value);
        }
    }
}
