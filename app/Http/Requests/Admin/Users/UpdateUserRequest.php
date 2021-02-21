<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'user_name' => 'required|unique:users,user_name,'.$this->route('id'),
            'email' => 'required|email|unique:users,email,'.$this->route('id'),
            'mobile' => 'required',
            'cpassword' => 'required_with:password|same:password',
        ];
    }

//required_with:postal_code1

    public function messages()
    {
        return [
            'id.required' => 'الرجاء إدخال رقم الملف بالكامل',
            'id.exists' => 'الريكورد غير موجود بالنظام',
            'name.required' => 'الرجاء إدخال الإسم بالكامل',
            'user_name.required' => 'الرجاء إدخال إسم المستخدم ',
            'user_name.unique' => 'إسم المستخدم مسجل مسبقا',
            'email.required' => 'الرجاء إدخال البريد الإلكتروني',
            'email.email' => 'الرجاء إدخال الصيغد الصحيحد للبريد الإلكتروني',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقا',
            'mobile.required' => 'الرجاء إدخال رقم الهاتف',
            'cpassword.required_with' => 'الرجاء إدخال تأكيد كلمة المرور',
            'cpassword.same' => 'تأكيد كلمد المرور يجب ان يكون مساوي لكلمة المرور',
        ];
    }
}
