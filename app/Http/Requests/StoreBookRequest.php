<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'string|required|max:255',
            'is_active' => 'boolean',
            'age' => 'integer|min:1990|max:2030',
            'cycle_number' => 'integer|max:100',
            'time' => 'string|max:8',
            'cycle_id' => 'integer',
            'description' => 'string|max:50000',
            'genre_slug' => 'string|max:50000',

            'image' => 'file|mimes:jpeg,png,webp',

            'authors' => 'array|required',
            'readers' => 'array|required',
            'genres' => 'array|required',
        ];
    }
}
