<?php

namespace App\Http\Requests\Admin;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'old_password' => ['nullable', 'max:100', 'min:6'],
            'new_password' => ['nullable', 'max:100', 'min:6'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
            'role' => ['required']
        ];
    }
}
