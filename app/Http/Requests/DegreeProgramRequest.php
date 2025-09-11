<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DegreeProgramRequest extends FormRequest
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
        $required = $this->isMethod('patch') ? 'sometimes' : 'required';
        return [
			'code' => [$required, 'string', 'unique:degree_programs,code,'],
			'name' => [$required, 'string'],
			'faculty_id' => [$required],
			'institution' => [$required, 'string'],
        ];
    }
}
