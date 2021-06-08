<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'required|alpha|max:30',
            'last_name' => 'required|alpha|max:30',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'user_id' => 'exists:users,id|nullable',
            'personal_identification_number' => 'required|unique:contacts'
        ];
    }
}
