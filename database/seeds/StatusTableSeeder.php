<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Status::insert([
            ['id' => 1, 'name' => 'Onafgerond'],
            ['id' => 2, 'name' => 'Nieuw'],
            ['id' => 3, 'name' => 'In behandeling'],
            ['id' => 4, 'name' => 'Klaar'],
            ['id' => 5, 'name' => 'Afgewezen'],
//            ['id' => 6, 'name' => 'Nieuw'],
//            ['id' => 7, 'name' => 'Nieuw'],
        ]);
    }
}
