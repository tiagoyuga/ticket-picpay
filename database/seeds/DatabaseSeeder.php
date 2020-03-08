<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //$this->call(RegionSeeder::class);
        //$this->call(StateSeeder::class);
        //$this->call(CityDevSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(GroupSeeder::class);
        // $this->call(DevSkillCategorySeeder::class);
        // $this->call(DevSkillOptionSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TicketStatusSeeder::class);
    }
}
