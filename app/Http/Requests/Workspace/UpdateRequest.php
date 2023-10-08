<?php

namespace App\Http\Requests\Workspace;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'name' => [
                'required',
                'max:50',
                Rule::unique('workspaces', 'name')->ignore($this->workspace->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The name has already been taken.',
            'name.max' => 'The quantity must be at small :max.',
        ];
    }
}
