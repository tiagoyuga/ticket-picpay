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
                'name' => 'Under development',
                'order' => 1
            ],
            [
                'name' => 'Under development',
                'order' => 2
            ],
            [
                'name' => 'Onhold',
                'order' => 3
            ],
            [
                'name' => 'Completed',
                'order' => 4
            ],
        ];

        foreach ($itens as $item) {

            \App\Models\TicketStatus::create($item);
        }
    }
}
