<?php

use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $map_id = Uuid::generate();
        $tileAmount = 10 * 10;

        factory('App\Map')->create([
            'id' => $map_id,
            'user_id' => 2,
        ]);

        factory('App\MapTile', $tileAmount)->create([
            'belongs_to_map' => $map_id,
        ]);

        $this->command->info('Maps created');
    }
}
