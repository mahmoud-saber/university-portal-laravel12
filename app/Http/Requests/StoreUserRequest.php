<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // يمكن تخصيصه حسب نوع المستخدم (admin, etc.)
    }

    public function rules(): array
    {
        $userId = $this->route('user'); // للتمييز بين create و update

        return [
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $userId],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
            'password' => [$userId ? 'nullable' : 'required', 'string', 'min:6'],
            'role' => ['required', 'string', 'in:admin,teacher,student'],
            'status' => ['required', 'integer', 'in:0,9,10'],
        ];
    }
}
