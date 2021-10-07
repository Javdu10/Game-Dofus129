<?php

namespace Azuriom\Plugin\Dofus129\Requests;

use Azuriom\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Http\FormRequest;
use Azuriom\Plugin\Dofus129\Rules\HasColumn;

class CharacterDatabaseRequest extends FormRequest
{
    public function rules()
    {
        $columnRule = new HasColumn(request()->dofus129_characters_tableName, 'dofus_characters');
        $settings = Setting::whereIn('name', [
            'dofus129_database_driver' ,
            'dofus129_database_host',
            'dofus129_database_port',
            'dofus129_database_username',
            'dofus129_database_password',
        ])->get()->keyBy('name')->all();
        
        $driverName = $settings['dofus129_database_driver']->value;
        $config = config("database.connections.$driverName");
        $config['database'] = request()->dofus129_characters_databaseName;
        $config['host'] = $settings['dofus129_database_host']->value;
        $config['port'] = $settings['dofus129_database_port']->value ?? null;
        $config['username'] = $settings['dofus129_database_username']->value;
        $config['password'] = $settings['dofus129_database_password']->value ?? null;
        config(['database.connections.dofus_characters' => $config]);
        DB::purge();
        return [
            'dofus129_characters_databaseName' => ['required', 'string',
                function ($attribute, $value, $fail) {
                    try {
                        DB::connection('dofus_characters')->getPdo();
                    } catch (\Throwable $th) {
                        $fail("The database : $value, doesn't exists OR The credentials are wrong OR The Database is not reacheable");
                    }
                }
            ],
            'dofus129_characters_tableName' => ['required', 'string',
                function ($attribute, $value, $fail) {
                    if (! Schema::connection('dofus_characters')->hasTable($value)) {
                        $fail("The table: $value, doesn't exists in the database: ".config('database.connections.dofus_characters.database'));
                    }
                }
            ],

            'dofus129_characters_primaryKey' => ['required', 'string', $columnRule],
            'dofus129_accounts_foreignKey' => ['required', 'string', $columnRule],
            'dofus129_characters_nameCol' => ['required', 'string', $columnRule],
            'dofus129_characters_sexeCol' => ['required', 'string', $columnRule],
            'dofus129_characters_classCol' => ['required', 'string', $columnRule],
            'dofus129_characters_levelCol' => ['required', 'string', $columnRule],
            'dofus129_characters_experienceCol' => ['required', 'string', $columnRule],
            'dofus129_characters_alignementCol' => ['required', 'string', $columnRule],
            'dofus129_characters_honorCol' => ['required', 'string', $columnRule],
        ];
    }
}
