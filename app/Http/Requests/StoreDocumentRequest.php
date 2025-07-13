<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // يمكن تعديلها بحسب الصلاحيات
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'file_path' => ['required', 'file', 'max:10240', 'mimes:png,jpeg,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx'],
            'file_type' => ['nullable', 'string', 'max:50'],
            'original_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
