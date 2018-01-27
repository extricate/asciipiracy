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
            'body' => 'You don\'t have an active ship, dummy; what are you gonna do? Swim?',
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
            'icon_type' => 'ra',
            'icon' => 'gold-bar',
            'frequency' => 1,
            'body' => 'An old captain in a nearby tavern drunkenly tells you about a chest he buried containing his legacy. He was too drunk to notice you scribbled down the majority of clues he left about its ',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'gold',
            'effect_changed' => '+ 1000 gold',
            'effect' => '1000',
        ]);

        DB::Table('events')->insert([
            'title' => 'Treasure found!',
            'icon_type' => 'ra',
            'icon' => 'gold-bar',
            'frequency' => 5,
            'body' => 'You find a half-buried chest whilst hunting on a small island. Now that\'s lucky!',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'gold',
            'effect_changed' => '+ 200 gold',
            'effect' => '200',
        ]);

        DB::Table('events')->insert([
            'title' => 'Ship hit a reef',
            'icon_type' => 'ra',
            'icon' => 'anchor',
            'frequency' => 2,
            'body' => 'Darn it, bloody navigator!',
            'type' => '-',
            'affects' => 'ship',
            'effect_on' => 'current_health',
            'effect_changed' => '- 50 ship hp',
            'effect' => '50',
        ]);

        DB::Table('events')->insert([
            'title' => 'Really good deal on goods!',
            'icon_type' => 'ra',
            'icon' => 'scroll-unfurled',
            'frequency' => 1,
            'body' => 'Let\'s explore some more!',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'goods',
            'effect_changed' => '+ 110 goods',
            'effect' => '110',
        ]);

        DB::Table('events')->insert([
            'title' => 'You encountered a friendly trader!',
            'icon_type' => 'ra',
            'icon' => 'scroll-unfurled',
            'frequency' => 1,
            'body' => 'He was more than happy to trade some of his goods with you.',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'goods',
            'effect_changed' => '+ 110 goods',
            'effect' => '110',
        ]);

        DB::Table('events')->insert([
            'title' => 'Pirates!',
            'icon_type' => 'ra',
            'icon' => 'skull',
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
