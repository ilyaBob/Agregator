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
            'title' => 'required|string|max:255',
            'link_to_original' => 'required|string|max:255',
            'is_active' => 'boolean',
            'age' => 'required|integer|min:1990|max:2030',
            'cycle_number' => 'required|integer|max:100',
            'time' => 'required|string|max:9|regex:/^(?:[0-9]{1,3}:)?[0-5]?[0-9]:[0-5][0-9]$/',
            'cycle_id' => 'required|integer|min:1',
            'description' => 'required|string|max:50000',
            'genre_slug' => 'required|string|max:50000|min:2',

            'image' => 'required|file|mimes:jpeg,png,webp',

            'authors' => 'array|required',
            'readers' => 'array|required',
            'genres' => 'array|required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле должно быть заполнено',
            'title.string' => 'Поле должно быть строкой',
            'title.max' => 'Максимальная дллина поля 255 символов',

            'cycle_id.required' => 'Поле должно быть заполнено',
            'cycle_id.min' => 'Поле должно быть заполнено',
            'genre_slug.min' => 'Поле должно быть заполнено',

            'age.required' => 'Поле должно быть заполнено',
            'cycle_number.required' => 'Поле должно быть заполнено',

            'time.required' => 'Поле должно быть заполнено',
            'time.max' => 'Время должно быть в формате 000:00:00',
            'time.regex' => 'Время должно быть в формате 000:00:00',

            'image.required' => 'Поле должно быть заполнено',
            'image.mimes' => 'Файл должен иметь тип jpeg, png, webp',
            'description.required' => 'Поле должно быть заполнено',

            'authors.required' => 'Поле должно быть заполнено',
            'readers.required' => 'Поле должно быть заполнено',
            'genres.required' => 'Поле должно быть заполнено',

        ];
    }

}
