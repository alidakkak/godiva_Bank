<?php

namespace App\Http\Requests;

use FontLib\Table\Type\name;
use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'number' => 'required|numeric|min:5',
            'city'=>"required|in:jedda,dammam,riyadh",
            'image' => 'required|string|base64image',
            'number_voucher'=>'required|numeric'
        ];
    }
}
