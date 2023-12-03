<?php

namespace App\Http\Requests;

use FontLib\Table\Type\name;
use Illuminate\Foundation\Http\FormRequest;

class ExistingVoucherRequest extends FormRequest
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
            'image' => 'required',
            'number_voucher'=>'required|numeric',
//            'number' => 'required|numeric|min:5',
//            'image' => 'required|string|base64image',
        ];
    }
}
