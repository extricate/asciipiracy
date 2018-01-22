<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/ships/' . $this->id;
    }

    public function draw(Ship $ship)
    {
        $decks = $ship->decks;
        $length = $ship->length;
        $masts = $ship->masts;
        $beam = $ship->beam;

        // draw the bow of the ship
        $row = 0;
        for ($i = 0; $i < $beam/5; $i++)
        {
            if ($row == 0)
            {
                echo "|<br>";
                $row++;
            }
            else if ($row >= 1)
            {
                echo "|" . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", ($row) +1) . "|" . "<br>";
                $row++;

                if ($row >= 4 && $masts >= 4)
                {
                    echo str_repeat("-----", $beam/10) . "[*]" . str_repeat("-----", $beam/10) . "<br>";
                    $masts--;
                }
            }

        }

        // draw the midship
        for ($i = 0; $i < $decks; $i++)
        {
            echo "\n";
            for ($i = 0; $i < $length/12; $i++)
            {
                for ($b = 0; $b < $masts; $b++)
                {
                    echo "|" . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", ($beam/5) +1) . "|<br>";

                    if ($b == 0 && $masts >= 2)
                    {
                        // add some masts
                        echo str_repeat("------", $beam/10) . "[*]" . str_repeat("------", $beam/10) . "<br>";
                        $masts--;
                    }
                }
                $i++;
            }
        }

        // draw the officers deck
        for ($i = 0; $i < $decks; $i++)
        {
            echo "\n";
            echo "|" . str_repeat("---", ($beam/5)) . "|<br>";
            for ($i = 0; $i < $length/20; $i++)
            {
                echo "|" . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", ($beam/4) +1) . "|<br>";
                $i++;

                if ($i >= 0 && $masts >= 1)
                {
                    echo str_repeat("-----", $beam/10) . "[*]" . str_repeat("-----", $beam/10) . "<br>";
                    $masts--;
                }
            }
        }
        echo str_repeat("---", ($beam/5) +1);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fireCannons()
    {

    }
}
