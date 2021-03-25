<?php

namespace Azuriom\Plugin\Dofus129\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Dofus129\Models\Character;

class LadderController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pvm()
    {
        $characters = Character::orderBy(setting('dofus129_accounts_experienceCol'), 'desc')->paginate(15);

        return view('dofus129::ladder.pvm', ['characters'=>$characters]);
    }

    public function pvp()
    {
        $characters = Character::orderBy(setting('dofus129_accounts_honorCol'), 'desc')->paginate(15);

        return view('dofus129::ladder.pvp', ['characters'=>$characters]);
    }
}
