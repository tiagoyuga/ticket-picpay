<?php

use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                "is_dev" => true,
                "name" => "Desenvolvedor",
                "email" => "dev@gmail.com",
                "group_id" => 5
            ),
            array(
                "is_dev" => true,
                "name" => "Dyego CTO",
                "email" => "cto@gmail.com",
                "group_id" => 4
            ),
            array(
                "is_dev" => true,
                "name" => "Gio ADM",
                "email" => "admin@gmail.com",
                "group_id" => 1
            ),
            array(
                "is_dev" => false,
                "name" => "Fulano Client",
                "email" => "client@gmail.com",
                "group_id" => 3
            ),
            array(
                "is_dev" => false,
                "name" => "Ciclano Client",
                "email" => "client@gmail.com",
                "group_id" => 3
            )
        );

        $password = Hash::make('12345678');

        foreach ($users as $item) {
            $item['password'] = $password;
            $user = User::create($item);
        }
    }
}
