<?php

use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::Table('events')->insert([
            'id' => '0',
            'title' => 'Not enough goods!',
            'frequency' => 1,
            'body' => 'You cannot travel without goods, you will surely perish!',
            'effect_on' => '',
            'effect_changed' => '',
            'effect' => '',
        ]);

        DB::Table('events')->insert([
            'id' => '2',
            'title' => 'Treasure found!',
            'frequency' => 1,
            'body' => 'You sell the booty for some gold!',
            'effect_on' => 'gold',
            'effect_changed' => '+ 100 gold',
            'effect' => '+100',
        ]);

        DB::Table('events')->insert([
            'id' => '3',
            'title' => 'Ship hit a reef',
            'frequency' => 1,
            'body' => 'Darn it, bloody navigator!',
            'effect_on' => 'ship_hp',
            'effect_changed' => '- 50 ship hp',
            'effect' => '-50',
        ]);

        DB::Table('events')->insert([
            'id' => '4',
            'title' => 'Really good deal on goods!',
            'frequency' => 1,
            'body' => 'Let\'s explore some more!',
            'effect_on' => 'goods',
            'effect_changed' => '+ 110 goods',
            'effect' => '+110',
        ]);

        DB::Table('events')->insert([
            'name' => 'Herman',
            'email' => 'hsfnelissen@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
