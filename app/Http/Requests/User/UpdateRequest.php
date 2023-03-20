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
            'name' => ['required', 'between:3,20'],
            // 'avatar' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,svg', 'max:4096'],   
            'country' => ['required'],
            'city' => ['required'],
            'languages' => ['required'],
            'phone' => ['sometimes'],
            'discord' => ['sometimes'],
            'tasks_done' => ['sometimes', 'numeric', 'integer', 'gte:0'],
            'projects_done' => ['sometimes', 'numeric', 'integer', 'gte:0'],
            'wasted_years' => ['sometimes', 'numeric', 'integer', 'gte:0'],
            'ip_address' => ['sometimes', 'ip'],
        ];
    }
}
