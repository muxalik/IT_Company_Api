<?php

namespace App\Http\Requests\Employee;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends EmployeeRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

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
            'salary' => ['required', 'numeric', 'integer', 'gt:0'],
            'avatar' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,svg', 'max:4096'],
            'country' => ['required'],
            'city' => ['required'],
            'languages' => ['required', 'array'],
            'languages.*' => ['required', 'string', 'regex:/\w{2}/'],
            'phone' => ['sometimes'],
            'discord' => ['sometimes'],
            'tasks_done' => ['sometimes', 'numeric', 'integer', 'gt:0'],
            'projects_done' => ['sometimes', 'numeric', 'integer', 'gt:0'],
            'wasted_years' => ['sometimes', 'numeric', 'integer', 'gt:0'],
            'ip_address' => ['sometimes', 'ip'],
        ];
    }
}
