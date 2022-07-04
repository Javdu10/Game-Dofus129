<?php

namespace Azuriom\Plugin\Dofus129\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login' => ['required', 'string', 'max:255'],
            'password' => ['confirmed', 'required', 'string', 'max:255'],
        ];
    }
}
