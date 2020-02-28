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
            ['id' => 1, 'name' => 'Onafgerond', 'button_class' => 'btn-secondary'],
            ['id' => 2, 'name' => 'Nieuw', 'button_class' => 'btn-success'],
            ['id' => 3, 'name' => 'In behandeling', 'button_class' => 'btn-primary'],
            ['id' => 4, 'name' => 'Klaar', 'button_class' => 'btn-success'],
            ['id' => 5, 'name' => 'Afgewezen', 'button_class' => 'btn-danger'],
//            ['id' => 6, 'name' => 'Nieuw'],
//            ['id' => 7, 'name' => 'Nieuw'],
        ]);
    }
}
