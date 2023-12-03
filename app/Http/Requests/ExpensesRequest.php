<?php

namespace App\Http\Requests;

use FontLib\Table\Type\name;
use Illuminate\Foundation\Http\FormRequest;

class ExpensesRequest extends FormRequest
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
            "name"=>'required|exists:customers,name',
            'image'=>'required|string|base64image',
            'amount'=>'required|numeric',
            'city'=>"required|in:jedda,dammam,riyadh",
            'number_voucher'=>'required|numeric|exists:vouchers,number_voucher',
        ];
    }
}
