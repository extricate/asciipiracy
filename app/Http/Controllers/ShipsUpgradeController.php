<?php

namespace App\Http\Controllers;

use App\Ship;
use Illuminate\Http\Request;

class ShipsUpgradeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('ships.upgrade', compact('ship'));
    }
}
