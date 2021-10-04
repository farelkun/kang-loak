<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class KycRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'address' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'id_card_attachment' => 'required',
            'selfie_id_card_attachment' => 'required'
        ];
    }
}
