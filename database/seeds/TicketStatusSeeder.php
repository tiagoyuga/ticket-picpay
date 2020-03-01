<?php
/**
 * @package    Seeder
 ****************************************************
 * @date       02/29/2020 11:47 AM
 */

use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $itens = [
            [
                'id' => 3,
                'name' => 'Under development',
                'order' => 2
            ],
            [
                'id' => 2,
                'name' => 'Ready for Client review',
                'order' => 3
            ],
            [
                'id' => 1,
                'name' => 'Ready for CTO review',
                'order' => 1
            ],
            [
                'id' => 5,
                'name' => 'Onhold',
                'order' => 0
            ],
            [
                'id' => 4,
                'name' => 'Completed',
                'order' => 4
            ],
        ];

        foreach ($itens as $item) {

            \App\Models\TicketStatus::create($item);
        }
    }
}
