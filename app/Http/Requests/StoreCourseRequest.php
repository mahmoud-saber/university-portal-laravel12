<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // أو تخصيصها بناءً على صلاحيات المستخدم
    }

    public function rules(): array
    {
        $courseId = $this->route('course'); // useful for update

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'teacher_id' => ['required', 'exists:users,id'],
        ];
    }
}
