<?php

namespace Azuriom\Plugin\Dofus129\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Dofus129\Models\Character;

class Dofus129HomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Character::orderBy(setting('dofus129_accounts_experienceCol') ?? 'xp')->get();
        dd($characters);
        return view('dofus129::index');
    }
}
