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
        ];
    }
}
