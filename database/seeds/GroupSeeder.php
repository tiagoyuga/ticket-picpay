<?php
/**
 * @package    Seeder
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
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
                'id' => 1,
                'name' => 'Admin'
            ],
            [
                'id' => 3,
                'name' => 'Client'
            ],
            [
                'id' => 4,
                'name' => 'CTO'
            ],
            [
                'id' => 5,
                'name' => 'Developer'
            ],

        ];

        foreach ($itens as $item) {

            \App\Models\Group::create($item);
        }
    }
}
