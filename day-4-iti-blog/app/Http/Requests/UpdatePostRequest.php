<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'min:3', Rule::unique('posts', 'title')->ignore($this->id)],
            'body' => 'required|min:10',
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Post must have a title',
            'title.min' => 'Title minimum length is 3 character',
            'title.unique' => 'A post with same title already exists',
            'body.required' => 'Post must have a body',
            'body.min' => 'Body must have at least 10 characters',
            'user_id.required' => 'Post must have a creator',
            'user_id.exists' => "Creator doesn't exist"
        ];
    }
}
