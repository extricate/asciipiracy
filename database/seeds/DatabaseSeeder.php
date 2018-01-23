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

        // only create admin user if it doesn't exist already
        if (DB::Table('users')->where(['name' => 'herman']) == false)
        {
            DB::Table('users')->insert([
                'name' => 'herman',
                'email' => 'hsfnelissen@gmail.com',
                'password' => bcrypt('secret'),
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
