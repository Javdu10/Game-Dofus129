<?php

namespace Azuriom\Plugin\Dofus129\Requests;

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

            'dofus129_customHashalgo' => ['required', 'string'],

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

            'dofus129_azuriom_password' => ['nullable', 'string'],
        ];
    }
}
