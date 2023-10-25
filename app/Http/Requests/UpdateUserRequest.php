<?php

namespace App\Http\Requests;

use FontLib\Table\Type\name;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'sometimes|required|string|min:3',
            'serial_number' => 'sometimes|required|numeric|unique:users,serial_number,'.$this->route("user"),
            'type'=>"sometimes|required|in:Super,Admin,Cashier",
            'password'=>"sometimes|required|min:5"
        ];
    }
}
