<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChitiethoadonnhapRequest extends FormRequest
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
            'dongia' =>['required','integer'],
            'hansudung'=>['required','date'],
            'hanghoa_id' => ['required', 'exists:hanghoas,id'],
            'nhacungcap_id' => ['required', 'exists:nhacungcaps,id'],
            'user_id' => ['required', 'exists:users,id'],
            // 'hoadonnhap_id' => ['required', 'exists:hoadonnhaps,id']
        ];
    }
}
