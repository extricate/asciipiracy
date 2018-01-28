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
            'body' => 'You cannot travel without goods, you and your crew will surely perish!',
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
            'body' => 'An old captain in a nearby tavern drunkenly tells you about a chest he buried containing his legacy. He was too drunk to notice you scribbled down the majority of clues he left about its location. That morning, you set out to find the treasure and behold - the old drunk was speaking the truth! Certainly, it would be a waste to leave this gold here for another captain to hear the drunks\' tales?',
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
            'body' => 'You find a half-buried chest whilst hunting on a small island. Now that\'s luck!',
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
            'title' => 'Rescued a carpenter!',
            'icon_type' => 'ra',
            'icon' => 'telescope',
            'frequency' => 2,
            'body' => 'Whilst roaming the seas a sailor spotted a small raft with a shipwrecked man. Apparently, he was a carpenter serving on a military vessel that was lost in a storm. He was very grateful for your rescue and decided to repair some ship damage. Upon returning to port he went to rejoin the military.',
            'type' => '+',
            'affects' => 'ship',
            'effect_on' => 'current_health',
            'effect_changed' => '+ 50 ship hp',
            'effect' => '50',
        ]);

        DB::Table('events')->insert([
            'title' => 'Free upgrades!',
            'icon_type' => 'ra',
            'icon' => 'hand-saw',
            'frequency' => 1,
            'body' => 'Upon returning to port you are approached by a man accompanied by two soldiers. He tells you that he has been looking for a ship exactly like yours. He continues to explain that he is the local shipwright, and that he has discovered a way to greatly improve the durability of ships! However, he has yet to find a ship that is suitable for the method. You reluctantly agree to have your ship be his guinea pig, after he tells you that you will be compensated dearly if the procedure fails. Luckily, the procedure goes fine and your ships\' durability has been increased!',
            'type' => '+',
            'affects' => 'ship',
            'effect_on' => 'maximum_health',
            'effect_changed' => '+ 50 maximum ship hp',
            'effect' => '50',
        ]);

        DB::Table('events')->insert([
            'title' => 'Free upgrades!',
            'icon_type' => 'ra',
            'icon' => 'hand-saw',
            'frequency' => 1,
            'body' => 'Upon returning to port you are approached by a man accompanied by a few soldiers. He tells you that he has been looking for a ship with a mast configuration that exactly matches yours. He continues to explain that he is the local shipwright, and that he has discovered a way to greatly improve the maneuverability of ships by tweaking their masts! However, he has yet to find a ship that is suitable for the method. You reluctantly agree to have your ship be his guinea pig, after he tells you that you will be compensated dearly if the procedure fails. Luckily, the procedure goes fine and your ships\' maneuverability has been increased!',
            'type' => '+',
            'affects' => 'ship',
            'effect_on' => 'maneuverability',
            'effect_changed' => '+ 5 maneuverability',
            'effect' => '5',
        ]);

        DB::Table('events')->insert([
            'title' => 'Really good deal on goods!',
            'icon_type' => 'ra',
            'icon' => 'scroll-unfurled',
            'frequency' => 3,
            'body' => 'In a local tavern, some shady people were talking about some smugglers that had cheap goods they needed to get rid of. You decided that it might be worth checking out; which resulted in you getting a really good deal on some goods!',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'goods',
            'effect_changed' => '+ 100 goods',
            'effect' => '100',
        ]);

        DB::Table('events')->insert([
            'title' => 'Uh, we appear to be lost...',
            'icon_type' => 'ra',
            'icon' => 'telescope',
            'frequency' => 3,
            'body' => 'Whilst roaming the seas, you encountered a small 30 feet trading vessel. The trader appeared to be lost due to their navigator falling overboard, with the only compass they had. You gave the trader your spare compass and sent them on their way. The trader was very grateful and even gave you some of their goods!',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'goods',
            'effect_changed' => '+ 50 goods',
            'effect' => '50',
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
