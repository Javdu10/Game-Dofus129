<?php

namespace Azuriom\Plugin\Dofus129\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;

class InstallController extends Controller
{
    public function index()
    {
        return view('dofus129::install.index');
    }
}
