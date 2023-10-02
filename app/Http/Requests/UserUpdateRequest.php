<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'id' => ['required', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->id)]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => auth()->id()
        ]);
    }
}
