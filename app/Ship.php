<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/ships/' . $this->id;
    }

    public function shipOptions()
    {
        // Return all the options of what you can do with a ship
        // Options for your own ships
        // Options for other ships
        // Currently implemented in blade
    }

    /**
     * A ship has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A ship has crew.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function crew()
    {
        return $this->hasMany(Person::class, 'ships_id');
    }

    public function draw(Ship $ship)
    {
        $decks = $ship->decks;
        $length = $ship->length;
        $masts = $ship->masts;
        $beam = $ship->beam;
        $cannons = $ship->cannons;

        if ($length >= 100) {
            echo "<p class=\"text-center small\" style=\"font-size: 7px; font-family: 'Courier New', Courier, monospace; font-weight: bold;\">";
        }

        elseif ($beam >= 40) {
            echo "<p class=\"text-center small\" style=\"font-size: 7px; font-family: 'Courier New', Courier, monospace; font-weight: bold;\">";
        }

        elseif ($length >= 200) {
            echo "<p class=\"text-center small\" style=\"font-size: 6px; font-family: 'Courier New', Courier, monospace; font-weight: bold;\">";
        }

        elseif ($length >= 300) {
            echo "<p class=\"text-center small\" style=\"font-size: 5px; font-family: 'Courier New', Courier, monospace; font-weight: bold;\">";
        }

        else {
            echo "<p class=\"text-center small\" style=\"font-size: 10px; font-family: 'Courier New', Courier, monospace; font-weight: bold;\">";
        }

        // draw the bow of the ship
        $row = 0;
        for ($i = 0; $i < $beam / 5; $i++) {
            if ($row == 0) {
                echo "||<br>";
                echo "||<br>";
                echo "_||_<br>";
                echo "||-||<br>";
                $row++;
            } else {
                if ($row >= 1) {
                    echo "||" . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", ($row) + 1) . "||" . "<br>";
                    $row++;

                    if ($row >= 4 && $masts >= 4) {
                        // add the foremast at the end of the bow if there's 4 masts
                        echo
                            str_repeat("~~~~~~~~", $beam / 8) . "<br>";
                        echo str_repeat("======", $beam / 10) . "[*]" . str_repeat("======", $beam / 10) . "<br>";
                        $masts--;
                    }
                }
            }
        }
        // draw the end of the bow seperator
        echo "| ||" . str_repeat("___", ($beam / 5) + 1) . "|| |<br>";
        echo "| ||" . str_repeat("---", ($beam / 5) + 1) . "|| |<br>";

        // draw the midship
        for ($i = 0; $i < $decks; $i++) {
            echo "\n";
            for ($i = 0; $i < $length / 24; $i++) {
                for ($b = 0; $b < $masts; $b++) {
                    // create the first set of midship segments
                    echo
                        "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 5) + 1) . "|| |<br>";

                    // add some cannons
                    echo
                        "=| ||" . str_repeat("&nbsp;&nbsp;&nbsp;",
                            ($beam / 5) + 1) . "|| |=<br>";

                    if ($b == 0 && $masts >= 2) {
                        // add some masts
                        echo
                            str_repeat("~~~~~~~~", $beam / 5) . "<br>";
                        echo
                            str_repeat("=========", $beam / 10) . "[0]" . str_repeat("=========", $beam / 10) . "<br>";
                        $masts--;
                    }
                }

                // Echo the rowboat if the ship is large enough
                if ($ship->length >= 120) {
                    echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;&nbsp;&nbsp;_&nbsp;&nbsp;&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                    echo "=| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;&nbsp;/_\\&nbsp;&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |=<br>";
                    echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;\'---\'&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                    echo "=| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;|___|&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |=<br>";
                    echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;|---|&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                    echo "=| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;|___|&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |=<br>";
                    echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;\'---\'&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                }

                // draw the single mast halfway the ship if the ship only has one mast
                if ($ship->masts == 1) {
                    echo
                        str_repeat("~~~~~~~~", $beam / 5) . "<br>";
                    echo
                        str_repeat("=========", $beam / 10) . "[0]" . str_repeat("=========", $beam / 10) . "<br>";

                    // and let's add a single hatch
                    // let's also add a hatch
                    echo
                        "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 5) + 1) . "|| |<br>";
                    echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;_____&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                    echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '|&nbsp;\'\'&nbsp;|' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                    echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;-----&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                }

                // halfway the ship now, let's add the rest
                for ($i = 0; $i < $length / 14; $i++) {
                    for ($b = 0; $b < $masts; $b++) {
                        // create the first set of midship segments
                        echo
                            "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 5) + 1) . "|| |<br>";

                        // add some cannons
                        echo
                            "=| ||" . str_repeat("&nbsp;&nbsp;&nbsp;",
                                ($beam / 5) + 1) . "|| |=<br>";

                        if ($b == 0 && $masts >= 2) {
                            // add a mast if there's still 2 or more left
                            echo
                                str_repeat("~~~~~~~~", $beam / 4) . "<br>";
                            echo
                                str_repeat("=========", $beam / 8) . "[0]" . str_repeat("=========", $beam / 8) . "<br>";

                            $masts--;

                            // let's also add a hatch
                            echo
                                "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 5) + 1) . "|| |<br>";
                            echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;_____&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                            echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '|&nbsp;\'\'&nbsp;|' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                            echo "| ||" . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . '&nbsp;-----&nbsp;' . str_repeat("&nbsp;&nbsp;&nbsp;", ($beam / 10)) . "|| |<br>";
                        }
                    }
                    $i++;

                }
            }
            // draw the officers deck seperator
            echo "| ||" . str_repeat("___", ($beam / 5) + 1) . "|| |<br>";
            echo "| ||" . str_repeat("---", ($beam / 5) + 1) . "|| |<br>";

            // draw the officers deck if the ship is large enough for an officers deck
            if ($ship->length >= 120) {
                for ($i = 0; $i < $decks; $i++) {
                    echo "\n";
                    echo "||" . str_repeat("===", ($beam / 4) +1) . "||<br>";
                    for ($i = 0; $i < $length / 14; $i++) {
                        echo "||" . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", ($beam / 5)) . "||<br>";
                        $i++;

                        if ($i >= 0 && $masts >= 1) {
                            // draw the last mast if there's still one or more left
                            echo
                                str_repeat("~~~~~~~~", ($beam / 5)+1) . "<br>";
                            echo str_repeat("========", $beam / 8) . "[0]" . str_repeat("========",
                                    $beam / 8) . "<br>";
                            $masts--;
                        }
                    }
                }
            }
            echo "||" . str_repeat("===", ($beam / 8) + 1) . "o" . str_repeat("===", ($beam / 8) + 1) . "||";
        }
        echo "</p>";
    }

    public function attackStatistics(Ship $ship)
    {
        // Attacking
        $cannons = $this->cannons;
        $cannon_caliber = $this->cannon_caliber;

        // cannon caliber to damage modifier values
        if ($this->cannon_caliber == '4 pounder')
        {
            $caliber_modifier = 4;
        } elseif ($this->cannon_caliber == '6 pounder')
        {
            $caliber_modifier = 6;
        } elseif ($this->cannon_caliber == '9 pounder')
        {
            $caliber_modifier = 9;
        } elseif ($this->cannon_caliber == '12 pounder')
        {
            $caliber_modifier = 12;
        } elseif ($this->cannon_caliber == '18 pounder')
        {
            $caliber_modifier = 18;
        } elseif ($this->cannon_caliber == '24 pounder')
        {
            $caliber_modifier = 24;
        } elseif ($this->cannon_caliber == '32 pounder')
        {
            $caliber_modifier = 32;
        } elseif ($this->cannon_caliber == '42 pounder')
        {
            $caliber_modifier = 42;
        } else {
            $caliber_modifier = 1;
        }

        $attack = $cannons * $caliber_modifier;
        $attack = round($attack, 0);

        return $attack;
    }

    public function escapeStatistics(Ship $ship)
    {
        // Escaping
        $max_speed = $this->max_speed;
        $maneuverability = $this->maneuverability;
        $escape = $max_speed * $maneuverability;
        $escape = round($escape, 0);

        return $escape;
    }

    /**
     * Calculates the health status of a ship
     *
     * @param Ship $ship
     * @return string
     */
    public function health(Ship $ship)
    {
        $current_health = $ship->current_health;
        $maximum_health = $ship->maximum_health;

        $diff = ((1 - $current_health / $maximum_health) * 100);

        $healthStatus = "default";

        if ($diff < 25) {
            // We're good
            $healthStatus = "success";
        } elseif ($diff >= 50) {
            // Getting worse
            $healthStatus = "warning";
        } elseif ($diff >= 75) {
            // Bad bad bad
            $healthStatus = "danger";
        }

        return $healthStatus;
    }

    /**
     * Determine class based on various variables
     *
     * @param Ship $ship
     */
    public function shipClass(Ship $ship)
    {
        // Determine class based on various variables
    }

    /**
     * Determine the value of a ship, i.e. for purchase, sale and repair costs.
     *
     * @param Ship $ship
     * @return float|int|mixed
     */
    public function shipValue(Ship $ship)
    {
        // Value in gold is based on maximum health, gunports, cannon_caliber, total hold, max sailors, max speed and maneuverability.

        $value = $ship->maximum_health + ($ship->gunports) + ($ship->total_hold / 1000) + $ship->max_sailors + $ship->max_speed * $ship->maneuverability;

        $value = round($value, 0);

        return $value;
    }

    public function explorationCost()
    {
        // Calculate the cost of exploration with this ship
        $ship = Auth::user()->activeShip();
        $cost = $ship->crew()->count();
        return $cost;
    }

    /**
     * Calculate the cost of repairing this ship
     *
     * @param Ship $ship
     * @return float|int|mixed|null
     */
    public function repairCost(Ship $ship)
    {
        if ($ship->current_health < $ship->maximum_health) {
            $missing_health = $ship->maximum_health - $ship->current_health;
            $cost_per_health = round($ship->maximum_health / 10, 0);
            $cost = $cost_per_health * $missing_health;

            return $cost;

        } elseif ($ship->current_health <= 0) {
            return null;
        } else {
            return $cost = 0;
        }
    }

    /**
     * Repair the ship
     *
     * @param Ship $ship
     */
    public function repairShip(Ship $ship)
    {
        $user = Auth::user();
        $ship->maximum_health;
        $ship->current_health;

        $cost = $this->repairCost($ship);

        if ($user->gold >= $cost) {
            // Repair the ship
            $user->gold = $user->gold - $cost;
            $user->save();

            $ship->current_health = $ship->maximum_health;
            $ship->save();
        } else {
            // User doesn't have the gold to repair this ship so we do nothing, deal with it
        }
    }
}
