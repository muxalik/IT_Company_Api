<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeRequest extends FormRequest
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
            //
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
