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

        self::createAShip();

        $this->call([
            EventsSeeder::class,
        ]);

        if (DB::Table('users')->where(['name' => 'Herman']) == true)
        {
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

            factory('App\Settlement')->create([
                'name' => 'Beginners Nest',
                'type' => 6,
            ]);
        }
    }

    function createAShip()
    {
        $ship = factory('App\Ship')->create();
        $generateSailorAmount = $ship->min_sailors;

        factory('App\Person', $generateSailorAmount)->create(['ships_id' => $ship->id]);

        $this->command->info('Ship created');
    }
}
