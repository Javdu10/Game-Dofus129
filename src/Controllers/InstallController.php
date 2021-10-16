<?php

namespace Azuriom\Plugin\Dofus129\Controllers;

use Azuriom\Models\User;
use Azuriom\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Dofus129\Models\Account;
use Azuriom\Plugin\Dofus129\Requests\CredsDatabaseRequest;
use Azuriom\Plugin\Dofus129\Requests\AccountDatabaseRequest;
use Azuriom\Plugin\Dofus129\Requests\CharacterDatabaseRequest;

class InstallController extends Controller
{
    protected $databaseDrivers = [
        'mysql' => 'MySQL/MariaDB',
        'pgsql' => 'PostgreSQL',
    ];

    public function index()
    {
        //Setting::updateSettings(['dofus129_installed' => 1]);
        $driver = config('database.default');
        $credentials = [
            'host' => config("database.connections.$driver.host"),
            'port' => config("database.connections.$driver.port"),
            'username' => config("database.connections.$driver.username"),
            'password' => config("database.connections.$driver.password"),
            'driver' => $driver,
        ];

        return view('dofus129::install.index', ['credentials'=>$credentials, 'databaseDrivers' => $this->databaseDrivers]);
    }

    public function credentialAccountDatabase(CredsDatabaseRequest $request)
    {
        Setting::updateSettings($request->validated());

        return redirect()->route('dofus129.install.indexAccountTable');
    }

    public function indexAccountTable()
    {
        return view('dofus129::install.accounts');
    }

    public function setupAccountTable(AccountDatabaseRequest $request)
    {
        Setting::updateSettings($request->validated());

        return redirect()->route('dofus129.install.indexCharacterTable');
    }

    public function indexCharacterTable()
    {
        return view('dofus129::install.characters');
    }

    public function setupCharacterTable(CharacterDatabaseRequest $request)
    {
        Setting::updateSettings($request->validated());
        $settings = DB::table('settings')
                ->where('name', 'like', 'dofus129%')
                ->get()->keyBy('name')->all();
        try {
            $driverName = $settings['dofus129_database_driver']->value;
            $config = config("database.connections.$driverName");
            $config['database'] = $settings['dofus129_accounts_databaseName']->value;
            $config['host'] = $settings['dofus129_database_host']->value;
            $config['port'] = $settings['dofus129_database_port']->value ?? null;
            $config['username'] = $settings['dofus129_database_username']->value;
            $config['password'] = $settings['dofus129_database_password']->value ?? null;
            config(['database.connections.dofus_accounts' => $config]);
            DB::purge();
            $account = new Account();
            $account->setTable($settings['dofus129_accounts_tableName']->value);
            $account->setKeyName($settings['dofus129_accounts_primaryKey']->value);
            $account->{$settings['dofus129_accounts_nameCol']->value} = Str::random(8);
            $account->{$settings['dofus129_accounts_pseudoCol']->value} = Str::random(8);
            $account->{$settings['dofus129_accounts_passwordCol']->value} = Str::random(8);
            $account->{$settings['dofus129_accounts_questionCol']->value} = Str::random(8);
            $account->{$settings['dofus129_accounts_answerCol']->value} = Str::random(8);
            $account->save();
    
            $account->delete();
        } catch (\Throwable $th) {
            if ($th->errorInfo[1] == 1364) {
                $str = $th->errorInfo[2].'<p><a href="https://github.com/Javdu10/Game-Dofus129#how-to-install" target="_blank">See the documentation to fix (click me)</a></p>';
                return redirect()->route('dofus129.install.indexCharacterTable')->with('error', $str)->withInput();
            } else {
                return redirect()->route('dofus129.install.indexCharacterTable')->with('error', $th->getMessage())->withInput();
            }
        }

        return redirect()->route('dofus129.install.indexAdminAccount');
    }

    public function indexAdminAccount()
    {
        return view('dofus129::install.admin');
    }

    public function setupAdminAccount(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'game_id' => null,
        ]);

        $user->markEmailAsVerified();
        $user->forceFill(['role_id' => 2])->save();

        return redirect()->route('install.finish');
    }
}
