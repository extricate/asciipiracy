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

        factory('App\Person', 750)->create();
        $this->command->info('People created');

        DB::Table('users')->insert([
            'name' => 'herman',
            'email' => 'hsfnelissen@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
