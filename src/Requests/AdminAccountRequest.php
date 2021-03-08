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
            'dofus129_accounts_databaseName' => ['nullable', 'string'],
            'dofus129_accounts_tableName' => ['nullable', 'string'],
            'dofus129_accounts_primaryKey' => ['nullable', 'string'],
            'dofus129_accounts_foreignKey' => ['nullable', 'string'],

            'dofus129_characters_databaseName' => ['nullable', 'string'],
            'dofus129_characters_tableName' => ['nullable', 'string'],
            'dofus129_characters_primaryKey' => ['nullable', 'string'],
            'dofus129_accounts_nameCol' => ['nullable', 'string'],
            'dofus129_accounts_sexeCol' => ['nullable', 'string'],
            'dofus129_accounts_classCol' => ['nullable', 'string'],
            'dofus129_accounts_levelCol' => ['nullable', 'string'],
            'dofus129_accounts_experienceCol' => ['nullable', 'string'],
            'dofus129_accounts_alignementCol' => ['nullable', 'string'],
            'dofus129_accounts_honorCol' => ['nullable', 'string'],
        ];
    }
}