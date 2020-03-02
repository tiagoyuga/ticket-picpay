<?php
/**
 * @package    Seeder
 ****************************************************
 * @date       02/28/2020 7:30 AM
 */

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
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
                'company_name' => 'Google',
                'contact_name' => 'Joao',
                'email' => 'google@google.com',
                'cell_phone' => '86999028214',
                'cto_amount' => 0.10,
            ],
        ];



        foreach ($itens as $item) {

            Cliente::create($item);
        }
    }
}
