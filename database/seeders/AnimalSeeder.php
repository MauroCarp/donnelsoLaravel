<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sex = array('m','f');
        $destination = array('engorde','faena','reproductive');
        $types = array('cerdo','ovino','chivo','vaca','pollo');

        foreach ($types as $key => $type) {

            for ($i=0; $i < 50; $i++) { 
                
                $animal = new Animal();
                $animal->type = $type;
                $animal->caravan = $i + 1;
                $animal->sex = $sex[rand(0,1)];
                $animal->destination = $destination[rand(0,2)];
                
                $animal->save();
            }

        }

    }
}
