<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    protected ?string $ip;

    public function __construct(Request $request)
    {
        $this->ip = $request->ip();
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
            'name' => ['required', 'between:3,20'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
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

    /**
     * Handle a passed validation attempt.
     */
    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated($key, $default);

        return array_merge(
            $validated,
            [
                'ip_address' => $this->ip,
                'languages' => Str::upper(implode(', ', $validated['languages'])),
            ]
        );
    }
}
