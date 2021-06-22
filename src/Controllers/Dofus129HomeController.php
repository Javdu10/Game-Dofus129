<?php

namespace Azuriom\Plugin\Dofus129\Controllers;

use Azuriom\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function update_character(Request $request)
    {
        $validated = $this->validate($request, [
            'character' => ['required'],
        ]);

        session(['m_idPlayer' => (int) $validated['character']]);

        return redirect()->back()->with('success', 'Selection reussi');
    }
}
