<?php

namespace Azuriom\Plugin\Dofus129\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dofus129_database_host' => ['nullable', 'string'],
            'dofus129_database_port' => ['nullable', 'string'],
            'dofus129_database_username' => ['nullable', 'string'],
            'dofus129_database_password' => ['nullable', 'string'],

            'dofus129_customHashalgo' => ['required', 'string'],

            'dofus129_accounts_databaseName' => ['nullable', 'string'],
            'dofus129_accounts_tableName' => ['nullable', 'string'],
            'dofus129_accounts_primaryKey' => ['nullable', 'string'],
            'dofus129_accounts_foreignKey' => ['nullable', 'string'],
            'dofus129_accounts_nameCol' => ['nullable', 'string'],
            'dofus129_accounts_passwordCol' => ['nullable', 'string'],
            'dofus129_accounts_pseudoCol' => ['nullable', 'string'],
            'dofus129_accounts_questionCol' => ['nullable', 'string'],
            'dofus129_accounts_answerCol' => ['nullable', 'string'],
            //'dofus129_accounts_loggedCol' => ['nullable', 'string'],

            'dofus129_characters_databaseName' => ['nullable', 'string'],
            'dofus129_characters_tableName' => ['nullable', 'string'],
            'dofus129_characters_primaryKey' => ['nullable', 'string'],
            'dofus129_characters_nameCol' => ['nullable', 'string'],
            'dofus129_characters_sexeCol' => ['nullable', 'string'],
            'dofus129_characters_classCol' => ['nullable', 'string'],
            'dofus129_characters_levelCol' => ['nullable', 'string'],
            'dofus129_characters_experienceCol' => ['nullable', 'string'],
            'dofus129_characters_alignementCol' => ['nullable', 'string'],
            'dofus129_characters_honorCol' => ['nullable', 'string'],
        ];
    }
}