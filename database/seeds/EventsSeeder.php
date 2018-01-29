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
        // System

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

        // Gold

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
            'title' => 'Message in a bottle',
            'icon_type' => 'ra',
            'icon' => 'broken-bottle',
            'frequency' => 5,
            'body' => 'Whilst exploring an island, you find a bottle on a secluded beach. It contains a message asking for help on a nearby island, with it\'s  stellar location detailed. Considering the island is only a short sail away, you check it out. Arriving on the tiny island you find a skeleton, sitting in the shade of a palm tree. The skeleton is covered in various jewelry and has a gold crown on top of its skull. The message must\'ve been sent ages ago, you think. You decide to take the jewelry to sell it back home.',
            'type' => '+',
            'affects' => 'user',
            'effect_on' => 'gold',
            'effect_changed' => '+ 150 gold',
            'effect' => '150',
        ]);

        DB::Table('events')->insert([
            'title' => 'Docking ticket!',
            'icon_type' => 'ra',
            'icon' => 'scroll-unfurled',
            'frequency' => 3,
            'body' => 'Upon returning to your ship from drinking in a local tavern, you find a pompous man accompanied by a few soldiers at the dock. "Sir, is this your ship?", he asks. When you answer in the affirmative, he immediately continues "Âre we aware that your ship is docked at a premium location, hm?". "Uh, no, I wasn\'t made aware of that no.". "That\'s what I thought! You captains are all the same, disrespecting local laws whenever the opportunity arises it so appears! Luckily, the governor has appointed me as the local docking inspector!". "Uh, well, I--", "And to worsen the offense you have also overstayed the maximum premium docking location time by no less than two hours! This simply will not stand! It will not stand at all!". "I\'m terribly so--". "This won\'t stand at all! Sadly, the governor has disallowed me to take any more captains into custody for docking offenses, but I can give you a hefty fine.". The docking inspector hands you a parchment and holds up his hands. You decide that it\'s in your best interest to simply pay the darn fine.',
            'type' => '-',
            'affects' => 'user',
            'effect_on' => 'gold',
            'effect_changed' => '- 220 gold',
            'effect' => '220',
        ]);

        // Ship

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
            'frequency' => 3,
            'body' => 'Whilst roaming the seas a sailor spotted a small raft with a shipwrecked man. Apparently, he was a carpenter serving on a military vessel that was lost in a storm. He was very grateful for your rescue and decided to repair some ship damage. Upon returning to port he went to rejoin the military.',
            'type' => '+',
            'affects' => 'ship',
            'effect_on' => 'current_health',
            'effect_changed' => '+ 50 ship hp',
            'effect' => '50',
        ]);

        DB::Table('events')->insert([
            'title' => 'Small fire',
            'icon_type' => 'ra',
            'icon' => 'lantern-flame',
            'frequency' => 2,
            'body' => 'After a few days of uneventful exploration, a small lantern fell on a stack of rope which started a small fire.',
            'type' => '-',
            'affects' => 'ship',
            'effect_on' => 'current_health',
            'effect_changed' => '- 15 ship hp',
            'effect' => '15',
        ]);

        DB::Table('events')->insert([
            'title' => 'Large fire',
            'icon_type' => 'ra',
            'icon' => 'fire',
            'frequency' => 100,
            'body' => 'On the high seas a large fire in the galley erupted. The fire seriously damaged the ship!',
            'type' => '-',
            'affects' => 'ship',
            'effect_on' => 'current_health',
            'effect_changed' => '- 100 ship hp',
            'effect' => '100',
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
            'title' => 'An abandoned fort!',
            'icon_type' => 'fa',
            'icon' => 'fort-awesome',
            'frequency' => 2,
            'body' => 'Whilst exploring the coast of an island, your lookout suddenly alarms that there is a fortress just around the next peninsula. You scream at the helm to make about, not feeling in the mood to die to fortress cannon fire today. However, shortly after the lookout yells that it appears to be abandoned. You decided that there might still be something worthwhile in the fortress. You and a couple of marines took a launch to explore the fortress. Sadly, it was properly abandoned and not much of value was left. However, there were still some cannons that matched your ship cannons caliber. You decided to take a few of them with you and ferry them to the ship. Hurray, extra cannons!',
            'type' => '+',
            'affects' => 'ship',
            'effect_on' => 'cannons',
            'effect_changed' => '+ 4 cannons (only added if you do not have the maximum amount of cannons yet)',
            'effect' => '4',
        ]);

        DB::Table('events')->insert([
            'title' => 'Unhandy merchant',
            'icon_type' => 'ra',
            'icon' => 'compass',
            'frequency' => 1,
            'body' => 'Walking through the town midday, you notice you\'re being followed. Immediately on guard, you act as if unaware and walk into an alley. As soon you are out of sight you draw your rapier and stand out of sight. A well dressed man turns around the corner, obviously looking for something. You immediately point your rapier at his throat and ask "Looking for me, sir?". The man stammers as he holds up his arms, "Oh my-- y-yes I was... eh...". "You must be the worst assassin I\'ve ever seen, although the outfit is quite interesting.". "A-a-assassin? Sir, I\'m no assassin I assure you! I\'m a trader! I mean you no harm, I merely wanted to inquire about your compass!". The man appears to be no threat, and thus you lower your rapier. "Hm, alright. My compass? What about it?". "I saw you looking at your compass when you came ashore. I have been looking for a compass exactly like it, I was wondering if I could perhaps purchase it?". "Uh, I guess so. Why do you need this particular compass, I\'m certain there\'s hundreds of compasses in this town for sale!". "Absolutely sir, however it\'s my wife... I accidentally dropped a compass heirloom of her late fathers. It meant the world to her, and now it\'s broken. I fear for she may never forgive me. Your compass however, is identical to that one. Therefore, I wish to replace the broken one with this one and she\'ll most likely never find out!". You decide that saving a marriage for a lousy compass might be a good trade. "Very well, what will you offer for the compass?". "Well, I appear to be a bit short on cash currently, however the local shipwright is in my debt quite significantly, I\'m certain that I can get him to fix any damage your ship might have right now for free!". You decide that that is a very good deal. "Very well, it\'s a deal!". The next day you purchase a new compass and return to your completely restored ship.',
            'type' => '+',
            'affects' => 'ship',
            'effect_on' => 'current_health',
            'effect_changed' => 'Ship fully healed!',
            'effect' => '500000',
        ]);

        // Goods

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
