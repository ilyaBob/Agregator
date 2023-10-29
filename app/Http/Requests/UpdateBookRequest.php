<?php

namespace App\Http\Requests;

use App\Rules\IsCycleId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => ['required','string','max:255',Rule::unique('books')->ignore($this->id)],
            'link_to_original' => 'required|string|max:255|url',
            'is_active' => 'boolean',
            'age' => 'required|integer|min:1990|max:2030',
            'time' => 'required|string|max:9|regex:/^(?:[0-9]{1,3}:)?[0-5]?[0-9]:[0-5][0-9]$/',

            'cycle_id' => 'integer',
            'cycle_number' => [new IsCycleId],

            'description' => 'required|string|max:50000',

            'image' => 'required|url',

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
            'title.unique' => 'Такое название уже есть',


            'link_to_original.url' => 'В поле должна быть указана ссылка',
            'image.url' => 'В поле должна быть указана ссылка',

            'genre_slug.min' => 'Поле должно быть заполнено',

            'age.required' => 'Поле должно быть заполнено',

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
