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
            'title' => 'No active ship!',
            'frequency' => 0,
            'body' => 'You don\'t have an active ship, dummy; what are you gonna do? Walk?',
            'type' => 'system',
            'affects' => 'system',
            'effect_on' => 'nothing',
            'effect_changed' => 'nothing',
            'effect' => 'nothing',
        ]);

        DB::Table('events')->insert([
            'title' => 'Not enough goods!',
            'frequency' => 0,
            'body' => 'You cannot travel without goods, you will surely perish!',
            'type' => 'system',
            'affects' => 'system',
            'effect_on' => 'nothing',
            'effect_changed' => 'nothing',
            'effect' => 'nothing',
        ]);

        DB::Table('events')->insert([
            'title' => 'Huge treasure found',
            'frequency' => 1,
            'body' => 'My that\'s a lot of gold...',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'gold',
            'effect_changed' => '+ 1000 gold',
            'effect' => '1000',
        ]);

        DB::Table('events')->insert([
            'title' => 'Treasure found!',
            'frequency' => 1,
            'body' => 'You sell the booty for some gold!',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'gold',
            'effect_changed' => '+ 100 gold',
            'effect' => '100',
        ]);

        DB::Table('events')->insert([
            'title' => 'Ship hit a reef',
            'frequency' => 1,
            'body' => 'Darn it, bloody navigator!',
            'type' => '-',
            'affects' => 'ship',
            'effect_on' => 'current_health',
            'effect_changed' => '- 50 ship hp',
            'effect' => '50',
        ]);

        DB::Table('events')->insert([
            'title' => 'Really good deal on goods!',
            'frequency' => 1,
            'body' => 'Let\'s explore some more!',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'goods',
            'effect_changed' => '+ 110 goods',
            'effect' => '110',
        ]);

        DB::Table('events')->insert([
            'title' => 'Pirates!',
            'frequency' => 1,
            'body' => 'Get ready for a fight!',
            'type' => 'combat',
            'affects' => 'ship',
            'effect_on' => '',
            'effect_changed' => '',
            'effect' => '',
        ]);

        $this->command->info('Events created');
    }
}
