<?php
/**
 * @package    Seeder
 * @author     Rupert Brasil Lustosa <rupertlustosa@gmail.com>
 * @date       09/12/2019 09:48:30
 */

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types = array(
            array(
                "id" => 1,
                "name" => "Adminstrator",
            ),
            array(
                "id" => 2,
                "name" => "Client",
            ),

        );

        foreach ($types as $item) {

            Type::create($item);
        }
    }
}
