<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChitiethoadonxuatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'soluong' =>['required','integer'],
            // 'dongia' =>['required','integer'],
            // 'kho_id' => ['required', 'exists:khos,id'],
            // 'hoadonxuat_id' => ['required', 'exists:hoadonxuats,id']
        ];
    }
}
