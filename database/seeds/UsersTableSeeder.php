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
                "email" => "dev@webholdingusa.com",
                "group_id" => 5
            ),
            array(
                "is_dev" => true,
                "name" => "Dyego CTO",
                "email" => "dyego@webholdingusa.com",
                "group_id" => 4
            ),
            array(
                "is_dev" => true,
                "name" => "Gio ADM",
                "email" => "gio@webholdingusa.com",
                "group_id" => 1
            ),
        );

        $password = Hash::make('111111');
        $company = \App\Models\Client::first();


        foreach ($users as $item) {
            $item['password'] = $password;
            $user = User::create($item);

            $company->usersTypeClient()->attach($user->id);
        }
    }
}
