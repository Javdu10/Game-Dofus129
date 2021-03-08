<?php

namespace Azuriom\Plugin\Dofus129\Controllers\Admin;

use Azuriom\Models\Setting;
use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Dofus129\Models\Account;
use Azuriom\Plugin\Dofus129\Requests\AdminAccountRequest;

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

    public function updateSettings(AdminAccountRequest $request)
    {
        Setting::updateSettings($request->validated());

        return redirect()->route('dofus129.admin.index')->with('success', 'Settings updated!');
    }
}
