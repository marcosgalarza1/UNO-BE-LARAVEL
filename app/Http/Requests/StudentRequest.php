<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
			'user_id' => [$required],
			'registration' => [$required, 'string', 'unique:students,registration,'],
			'degree_program_id' => [$required],
			'semester' => [$required],
			'birth_date' => [$required],
        ];
    }
}
