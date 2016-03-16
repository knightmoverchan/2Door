<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CashierRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname' => 'required|max:30',
            'lname' => 'required|max:30',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'address' => 'required|max:255',
            'contact_num' => 'required|min:11|numeric'
        ];
    }
}
