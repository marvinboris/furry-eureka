<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Status::create(['name' => 'IR']);
        Status::create(['name' => 'Activate']);
        Status::create(['name' => 'Stand 1']);
        Status::create(['name' => 'Stand 4']);
        Status::create(['name' => 'ICE']);
    }
}
