<?php

namespace Azuriom\Plugin\Dofus129\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Dofus129\Models\Account;
use Azuriom\Plugin\Dofus129\Models\GameAndWebRelation;
use Azuriom\Plugin\Dofus129\Requests\AccountRequest;
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
        $relations = GameAndWebRelation::with(['characters', 'account'])->where('azuriom_id', auth()->id())->get();

        return view('dofus129::accounts.index', ['relations' => $relations]);
    }

    public function store(AccountRequest $request)
    {
        if (GameAndWebRelation::where('azuriom_id', auth()->id())->count() > 7) {
            return redirect()->route('dofus129.accounts.index')->with('error', 'You can only have 8 game accounts');
        }

        $data = $request->validated();
        $account = new Account();
        $account->setTable(setting('dofus129_accounts_tableName'));
        $account->setKeyName(setting('dofus129_accounts_primaryKey'));

        $account->{setting('dofus129_accounts_nameCol')} = $data['login'];
        $account->{setting('dofus129_accounts_pseudoCol')} = $data['login'];
        $account->{setting('dofus129_accounts_passwordCol')} = dofus_customHashForPassword($data['password']);
        $account->{setting('dofus129_accounts_questionCol')} = 'Type : "Yes"';
        $account->{setting('dofus129_accounts_answerCol')} = 'Yes';
        $account->save();

        GameAndWebRelation::create([
            'azuriom_id' => auth()->id(),
            'dofus_id' => $account->{setting('dofus129_accounts_primaryKey')},
        ]);

        return redirect()->route('dofus129.accounts.index')->with('success', 'Your account has been created!');
    }

    public function updatePassword($accountId, Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string|confirmed',
        ]);

        $relation = GameAndWebRelation::with('account')->where([
            ['azuriom_id', auth()->id()],
            ['dofus_id', $accountId],
        ])->firstOrFail();

        $relation->account->{setting('dofus129_accounts_passwordCol')} = dofus_customHashForPassword($validated['password']);
        $relation->account->save();

        return redirect()->route('dofus129.accounts.index')->with('success', trans('messages.profile.updated'));
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
