<?php
/**
 * @package    Seeder
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $itens = [];

        foreach ($itens as $item) {

            \App\Models\Ticket::create($item);
        }
    }
}
		