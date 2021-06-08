<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class TicketStoreRequest extends FormRequest
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
            'name' => 'required|alpha_num|max:150',
            'description' => 'required|max:750',
            'ticket_type_id' => 'exists:ticket_types,id',
            'contact_id' => 'exists:contacts,id',
            'user_id' => 'exists:users,id',
            'due_date' => 'nullable|date',
            'is_done' => 'nullable|boolean'
        ];
    }
}
