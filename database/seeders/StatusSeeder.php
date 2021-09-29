<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id'          => Status::NIEUW,
                'name'        => 'Nieuw',
                'color_class' => 'bg-black',
            ],
            [
                'id'          => Status::IN_BEHANDELING,
                'name'        => 'In behandeling',
                'color_class' => 'bg-blue-500',
            ],
            [
                'id'          => Status::KLAAR,
                'name'        => 'Klaar',
                'color_class' => 'bg-green-500',
            ],
            [
                'id'          => Status::AFGEWEZEN,
                'name'        => 'Afgewezen',
                'color_class' => 'bg-red-500',
            ],
        ];

        Status::truncate();

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
