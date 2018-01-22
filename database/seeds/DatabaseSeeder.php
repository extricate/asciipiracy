<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Ship', 50)->create();
        $this->command->info('Ships seeded');
        // $this->call(UsersTableSeeder::class);
    }
}
