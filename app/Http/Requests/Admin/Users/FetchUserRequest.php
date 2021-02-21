<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class FetchUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:users',

        ];
    }

//required_with:postal_code1

    public function messages()
    {
        return [

            'id.required' => 'الرجاء إدخال رقم الملف بالكامل',
            'id.exists' => 'العنصر غير موجود بالنظام',

        ];
    }
}