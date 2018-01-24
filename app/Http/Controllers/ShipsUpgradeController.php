<?php

namespace App\Http\Controllers;

use App\Ship;
use Illuminate\Http\Request;

class ShipsUpgradeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        return view('ships.upgrade', compact('ship'));
    }
}
