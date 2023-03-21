<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Password;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'between:3,20'],
            'avatar' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,svg', 'max:4096'],   
            'country' => ['sometimes'],
            'city' => ['sometimes'],
            'languages' => ['sometimes', 'array'],
            'languages.*' => ['sometimes', 'string', 'regex:/\w{2}/'],
            'phone' => ['sometimes'],
            'discord' => ['sometimes'],
            'tasks_done' => ['sometimes', 'numeric', 'integer', 'gt:0'],
            'projects_done' => ['sometimes', 'numeric', 'integer', 'gt:0'],
            'wasted_years' => ['sometimes', 'numeric', 'integer', 'gt:0'],
            'ip_address' => ['sometimes', 'ip'],
        ];
    }
}
