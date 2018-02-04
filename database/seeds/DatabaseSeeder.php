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

        $this->call([
            EventsSeeder::class,
            MapSeeder::class,
        ]);


        DB::Table('users')->insert([
            'name' => 'NPC',
            'email' => 'npc@asciipiracy.com',
            'password' => bcrypt('secret'),
            'gold' => '100000',
            'goods' => '100000',
        ]);

        DB::Table('users')->insert([
            'name' => 'Herman',
            'email' => 'hsfnelissen@gmail.com',
            'password' => bcrypt('secret'),
            'gold' => '100000',
            'goods' => '100000',
            'max_ships' => '20',
        ]);

        factory('App\Ship')->create([
            'user_id' => '2',
            'masts' => '4'
        ]);

        factory('App\Settlement')->create([
            'name' => 'Beginners Nest',
            'type' => 6,
        ]);
    }
}
