<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequestDeliveryRequest extends Request
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
            'receiverFname' => 'required|max:30',
            'receiverLname' => 'required|max:30',
            'receiverAddress' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'description' => 'required|max:255',
            'receiverContact' => 'required|min:11|numeric'
        ];
    }
}
