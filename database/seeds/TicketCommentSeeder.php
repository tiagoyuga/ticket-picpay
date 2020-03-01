<?php
/**
 * @package    Seeder
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

use Illuminate\Database\Seeder;

class TicketCommentSeeder extends Seeder
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

            \App\Models\TicketComment::create($item);
        }
    }
}
		