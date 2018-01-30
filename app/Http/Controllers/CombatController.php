<?php

namespace App\Http\Controllers;

use App;
use App\Ship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CombatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $ship = $user->activeShip();

        // check if user has an active ship, else show an error message and exit scenario
        if ($user->active_ship == null) {
            return redirect(route('home'))->with('message',
                'You do not have an active ship to fight anybody with silly.');
        }

        if ($user->is_in_combat == false) {
            // if the user is not in combat yet, create a new enemy
            $enemy = $this->createEnemy();
            $user->is_in_combat = true;
            $user->is_in_combat_with = $enemy->id;
            $user->save();

            // show the message that the user encountered a new enemy
            $message = 'You encounter an enemy pirate ship called ' . $enemy->name;
        } else {
            $enemy = $target = Ship::findOrFail($user->is_in_combat_with);

            // show the message that the user encountered a new enemy
            $message = 'You are fighting the ' . $enemy->name;
        }

        $baseEscapeChance = $this->escapeChance();
        return view('combat.show', compact('user', 'ship', 'enemy', 'baseEscapeChance'));
    }

    public function startCombat()
    {
        $user = Auth::user();
        $ship = Auth::user()->activeShip();

        // check if user has an active ship, else show an error message
        if ($user->active_ship == null) {
            return redirect(route('home'))->with('message',
                'You do not have an active ship to fight anybody with.');
        }

        // create the opponent for the combat scenario
        //$enemy = $this->createEnemy();

        return view('combat.show', compact('enemy', 'user', 'ship', 'message'));
    }

    public function createEnemy()
    {
        // create the enemy
        $enemy = factory(Ship::class)->create();
        $generateSailorAmount = $enemy->min_sailors;
        // populate the enemy ship with crew
        factory(App\Person::class, $generateSailorAmount)->create([
            'ships_id' => $enemy->id
        ]);

        return $enemy;
    }

    /**
     * User attacks the ship it is in combat with
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function attack()
    {
        $user = Auth::user();

        if ($user->is_in_combat == true) {
            $ship = $user->activeShip();
            $enemy = Ship::findOrFail($user->is_in_combat_with);

            // accuracy logic
            $accuracy_types = array(
                'grazes',
                'glances',
                'hits',
                'penetrates',
                'smashes',
                'wrecks'
            );
            $accuracy_modifiers = array(
                0.625,
                0.750,
                1.000,
                1.250,
                1.490,
                3
            );

            // determine actual damage
            $damage_reduction = 0.5;

            $selected_accuracy = array_rand($accuracy_types);
            $actual_accuracy = $accuracy_modifiers[$selected_accuracy];
            $damage = $ship->attackStatistics($ship) * $actual_accuracy * $damage_reduction;
            $damage = round($damage, 0);

            $selected_accuracy_return = array_rand($accuracy_types);
            $actual_accuracy_return = $accuracy_modifiers[$selected_accuracy_return];
            $return_damage = $enemy->attackStatistics($enemy) * $actual_accuracy_return * $damage_reduction;
            $return_damage = round($return_damage, 0);

            if ($enemy->current_health <= $damage) {
                // First, gather the spoils of war to output them in the return message
                $reward_array = $this->rewards();
                $reward_gold = $reward_array[0];
                $reward_goods = $reward_array[1];
                $reward_experience = $reward_array[2];

                // Then actually start the win function and delete
                $this->win();

                return redirect(route('combat_end'))->with('result',
                    '<span class="fa-5x text-center"><i class="fa fa-trophy "></i></span>' .
                    '<p>Most tactfully, your navigator has positioned the ship for a full broadside off the stern, approaching the enemy from the rear at approximately 400 meters as she attempts to turn downwind. As soon the cannons are reloaded the Chief Gunner shouts "Cannons ready!". The crew now monitors you closely, awaiting your command. You monitor the enemy ship through your looking glass. Your first officer asks if he should give the command to fire. You answer him quietly: "Hold fire", which he relays to the crew. "Hold fire!" can be hear multiple times as the officers relay it to the rest of the crew. A lesson you have been taught a long time ago is knowing when to fire, and when to wait". A truly killing blow needs expert timing, for cannons are hardly precision instruments. "Almost there now", you whisper. As the crew grows completely quiet in anticipation of your command, you listen to the soothing sound of seagulls and the the waves breaking on the bow of the ship. You think about the enemy crew and captain. You wonder what this victory will bring for all of you. The enemy ship is almost turned, close to unleashing another broadside. Such a shame that a lovely ship like that has to be sunk.</p>' .
                    '<p>"FIRE!", as soon as you relay your command it can be hear a couple of times more, before the sound of exploding cannons drowns out all sound. As soon as the smoke clears, cheers erupt. The enemy ship is on fire and will soon be no more. Victory!</p>' .
                    '<p>From the wreckage, some items are retrieved... ' .
                    $reward_gold .
                    ' gold worth of cargo, and supplies worth ' .
                    $reward_goods .
                    ' crates of goods. That\'ll come in handy!</p> <p class="text-center"><span class="label label-success"> + ' .
                    $reward_gold .
                    ' gold <i class="ra ra-gold-bar"></i> ' .
                    '</span> <span class="label label-success"> ' .
                    ' + ' .
                    $reward_goods .
                    ' goods <i class="ra ra-chicken-leg"></i></span>' .
                    ' <span class="label label-success"> ' .
                    ' + ' .
                    $reward_experience .
                    ' experience</span></p>'
                );

            } else {
                $enemy->current_health = $enemy->current_health - $damage;
                $enemy->save();
            }

            if ($ship->current_health <= $return_damage) {
                // apparently the ship was destroyed in the attack
                $crew_count = $ship->crew->count();
                $this->lose();
                $this->endCombat();
                return redirect(route('combat_end'))->with('result',
                    '<p class="fa-5x text-center"><i class="ra ra-skull "></i></p>' .
                    '<p>As your ship takes the final broadside from the enemy, a falling mast knocks you overboard... whilst dropping to your certain demise you contemplate what you could\'ve done differently.</p>' .
                    '<p>Alass, the ship, cargo and crew are lost, but perhaps you will survive to fight another day.</p>' .
                    '<p>The ' .
                    $ship->name .
                    ' and its ' .
                    $crew_count .
                    ' crew are lost.</p>' .
                    '<p class="text-center"><span class="label label-danger">The ' .
                    $ship->name .
                    ' has sunk</span></p>'
                );
            } else {
                // take the damage like a champ
                $ship->current_health = $ship->current_health - $return_damage;
                $ship->save();
            }

            // return the damage message
            return redirect(route('view_combat'))->with('attack',
                '<p>Your broadside <b>' . $accuracy_types[$selected_accuracy] . '</b> the <b>' . $enemy->name . '</b> for <b>' . $damage . ' damage</b>' . '</p><p>' . 'The enemies broadside <b>' . $accuracy_types[$selected_accuracy_return] . '</b> your <b>' . $ship->name . '</b> for <b>' . $return_damage . ' damage</b>' . '</p>');

        } else {
            // user is not in combat, redirect to the combat index without doing anything
            return redirect(route('home'))->with('You are not, or are no longer, in combat');
        }
    }

    public function escapeChance()
    {
        $user = Auth::user();

        if ($user->is_in_combat == true) {
            $ship = $user->activeShip();
            $enemy = Ship::findOrFail($user->is_in_combat_with);

            $escape = $ship->escapeStatistics($ship);
            $chase = $enemy->escapeStatistics($enemy);

            // base escape chance is 60% when enemy and user have the same skills
            $baseEscape = 60;
            // the base is changed based on the difference in skills, user has higher skills?
            // then the base is adjusted positively, and vice-versa.

            // calculate the difference in skills as a percentage
            $escapeSkillDifference = round((1 - $chase / $escape) * 100, 0);
            $escapeChance = $baseEscape + $escapeSkillDifference;

            // let's add permanent uncertainty in the mix
            if ($escapeChance > 100) $escapeChance = 95;
            if ($escapeChance < 0) $escapeChance = 5;

            return $escapeChance;
        }

    }

    public function escape()
    {
        $user = Auth::user();
        $ship = $user->activeShip();

        if ($user->is_in_combat == true) {
            // roll escape statistics
            $escapeChance = $this->escapeChance();
            $escapeRoll = mt_rand(0, 100);

            if ($escapeChance > $escapeRoll) {
                $this->win();
                return redirect(route('combat_end'))->with('result',
                    '<span class="fa-5x text-center"><i class="fa fa-life-ring "></i></span>' .
                    '<p>All that remains of the enemy is but a small spot against the blue horizon. We successfully escaped.</p>');
            } else {
                $this->attack();
                if ($user->active_ship != null) {
                    return redirect(route('view_combat'))->with('message',
                        'Failed to escape! Whilst trying to escape, the enemy fired and you returned fire!');
                } else {
                    $this->endCombat();
                    return redirect(route('combat_end'))->with('result',
                        '<p class="fa-5x text-center"><i class="ra ra-skull "></i></p>' .
                        '<p>As hard as you and your crew try, you cannot seem to outrun the enemy. Eventually, they catch up and unleash a devastating final broadside. As a falling mast knocks you overboard to your certain demise, you contemplate what you could\'ve done differently.</p>' .
                        '<p>Alass, the ship, cargo and crew are lost, but perhaps you will survive to fight another day.</p>' .
                        '<p class="text-center"><span class="label label-danger">The ' .
                        $ship->name .
                        ' has sunk</span></p>');
                }
            }
        }
    }

    public function surrender()
    {
        // to surrender we just end the fight and lose
    }

    public function board()
    {
        // to board we first approach for 1 turn
        // then we grapple for 1 turn
        // then we fight on deck for 2 turns,
        // during which we get to choose to retreat and end the boarding and return to the combat (based on escape stat and random events)
        // then the winner gets to claim the other ship
    }

    public function sink($id)
    {
        //
    }

    /**
     * Rewards logic if user has won
     *
     * @return array
     */
    public function rewards()
    {
        $user = Auth::user();
        $ship = $user->activeShip();
        // to win the opponent must either: surrender or sink
        $user->combat_wins++;
        // find the correct ship
        $enemy = Ship::findOrFail($user->is_in_combat_with);

        // Rewards logic and persisting rewards
        $enemy_combat = $enemy->attackStatistics($enemy);
        $enemy_escape = $enemy->escapeStatistics($enemy);
        $reward_gold = mt_rand(0, $enemy_combat * 3) + 100;
        $reward_goods = mt_rand(0, $enemy_escape * 2) + 10;
        $reward_experience = mt_rand($enemy_combat / 10, $enemy_combat / 2) + 10;

        $user->gold = $user->gold + $reward_gold;
        $user->goods = $user->goods + $reward_goods;
        $user->experience = $user->experience + $reward_experience;
        $user->save();

        $rewards = array($reward_gold, $reward_goods, $reward_experience);

        return $rewards;
    }

    /**
     * Win function
     */
    public function win()
    {
        $user = Auth::user();

        // to win the opponent must either: surrender or sink
        $user->combat_wins++;
        // find the correct ship
        $enemy = Ship::findOrFail($user->is_in_combat_with);
        // delete the ship
        $enemy->delete();

        $user->is_in_combat = false;
        $user->is_in_combat_with = 0;
        $user->save();
    }

    public function lose()
    {
        $user = Auth::user();
        $ship = $user->activeShip();

        $user->combat_losses++;
        // for some reason I cannot force constraint thus manually set active ship to null
        $user->active_ship = 0;
        $user->save();

        $ship->delete();
        $this->endCombat();
    }

    public function capture()
    {
        // capture is the winning scenario for boarding
    }

    public function endCombat()
    {
        // End the combat scenario
        $user = Auth::user();

        if ($user->is_in_combat_with == null) {
            $user->is_in_combat = false;
            $user->is_in_combat_with = 0;
            $user->save();

            return view('combat.end');
        } elseif ($user->activeShip() == null) {
            // apparently we lost
            $user->is_in_combat = false;
            $user->is_in_combat_with = 0;
            $user->save();

            return view('combat.end');
        } else {
            return redirect(route('view_combat'))->with('message',
                'You might want to finish your fight before you try to magically win!');;
        }
    }
}
