<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Type::create(['name' => 'Invitation']);
        Type::create(['name' => 'Présentation']);
        Type::create(['name' => 'Suivi']);
        Type::create(['name' => 'Présence au bureau']);
        Type::create(['name' => 'Achat']);
    }
}
