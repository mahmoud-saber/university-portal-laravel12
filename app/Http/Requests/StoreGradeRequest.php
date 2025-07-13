<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:users,id|integer',
            'course_id' => 'required|exists:courses,id|integer',
            'grade' => 'nullable|string|max:10',
        ];
    }
}
