<?php

namespace Azuriom\Plugin\Dofus129\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CredsDatabaseRequest extends FormRequest
{
    public function rules()
    {
        $driverName = request()->dofus129_database_driver;
        $config = config("database.connections.$driverName");
        $config['database'] = request()->dofus129_accounts_databaseName;
        $config['host'] = request()->dofus129_database_host;
        $config['port'] = request()->dofus129_database_port;
        $config['username'] = request()->dofus129_database_username;
        $config['password'] = request()->dofus129_database_password;
        config(['database.connections.dofus_accounts' => $config]);
        DB::purge();

        return [
            'dofus129_database_driver' => ['required', 'string', 'in:mysql,pgsql'],
            'dofus129_database_host' => ['required', 'string'],
            'dofus129_database_port' => ['nullable', 'integer', 'between:1,65535'],
            'dofus129_database_username' => ['required', 'string'],
            'dofus129_database_password' => ['nullable'],
            'dofus129_accounts_databaseName' => ['required', 'string',
                function ($attribute, $value, $fail) {
                    try {
                        DB::connection('dofus_accounts')->getPdo();
                    } catch (\Throwable $th) {
                        $fail("The database : $value, doesn't exists OR The credentials are wrong OR The Database is not reacheable");
                    }
                }
            ],
        ];
    }
}
