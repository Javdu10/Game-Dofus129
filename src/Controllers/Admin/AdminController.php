<?php

namespace Azuriom\Plugin\Dofus129\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dofus129::admin.index');
    }
}
