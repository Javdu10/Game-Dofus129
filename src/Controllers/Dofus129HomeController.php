<?php

namespace Azuriom\Plugin\Dofus129\Controllers;

use Azuriom\Http\Controllers\Controller;

class Dofus129HomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dofus129::index');
    }
}
