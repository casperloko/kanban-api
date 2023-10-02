<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardUpdateRequest extends FormRequest
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
            'id' => ['required','int', Rule::exists('cards','id')],
            'name' => ['required','max:255'],
            'description' => ['string'],
            'board' => ['required', 'int', Rule::exists('boards', 'id')
                ->where('user_id', auth()->id())],
            'columnId' => ['required', 'int',Rule::exists('columns', 'id')
                ->where('board_id', $this->route('boards'))]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
//            'column' => $this->route('columnId'),
            'board' => $this->route('boards'),
            'id' => $this->route('id'),
        ]);
    }
}
