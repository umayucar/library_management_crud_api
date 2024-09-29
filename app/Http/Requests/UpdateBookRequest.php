<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'library_id' => 'nullable|exists:libraries,id',
            'publication_year' => 'nullable|integer',
            'publisher' => 'nullable|string|max:255',
            'page_count' => 'nullable|integer',
        ];
    }
}
