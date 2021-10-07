<?php

namespace Azuriom\Plugin\Dofus129\Requests;

use Azuriom\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Http\FormRequest;
use Azuriom\Plugin\Dofus129\Rules\HasColumn;

class AccountDatabaseRequest extends FormRequest
{
    public function rules()
    {
        $columnRule = new HasColumn(request()->dofus129_accounts_tableName ?? '', 'dofus_accounts');
        $settings = Setting::whereIn('name', [
            'dofus129_database_driver' ,
            'dofus129_accounts_databaseName',
            'dofus129_database_host',
            'dofus129_database_port',
            'dofus129_database_username',
            'dofus129_database_password',
        ])->get()->keyBy('name')->all();
        $driverName = $settings['dofus129_database_driver']->value;
        $config = config("database.connections.$driverName");
        $config['database'] = $settings['dofus129_accounts_databaseName']->value;
        $config['host'] = $settings['dofus129_database_host']->value;
        $config['port'] = $settings['dofus129_database_port']->value ?? null;
        $config['username'] = $settings['dofus129_database_username']->value;
        $config['password'] = $settings['dofus129_database_password']->value ?? null;
        config(['database.connections.dofus_accounts' => $config]);
        DB::purge();
        return [
            
            'dofus129_accounts_tableName' => ['required', 'string',
                function ($attribute, $value, $fail) {
                    if (! Schema::connection('dofus_accounts')->hasTable($value)) {
                        $fail("The table: $value, doesn't exists in the database: ".config('database.connections.dofus_accounts.database'));
                    }
                }
            ],
            'dofus129_accounts_primaryKey' => ['required', 'string', $columnRule],
            'dofus129_accounts_nameCol' => ['required', 'string', $columnRule],
            'dofus129_accounts_passwordCol' => ['required', 'string', $columnRule],
            'dofus129_accounts_pseudoCol' => ['required', 'string', $columnRule],
            'dofus129_accounts_questionCol' => ['required', 'string', $columnRule],
            'dofus129_accounts_answerCol' => ['required', 'string', $columnRule],
        ];
    }
}
