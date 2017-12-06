<?php

use Illuminate\Database\Seeder;
use App\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create([
        	'slug' => 'urg',
        	'nome' => 'Urgente',
        ]);

        Tipo::create([
        	'slug' => 'imp',
        	'nome' => 'Importante',
        ]);

        Tipo::create([
        	'slug' => 'norm',
        	'nome' => 'Tranquilo',
        ]);

    }
}
