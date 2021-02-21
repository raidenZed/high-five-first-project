<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string',
            'user_name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'mobile' => 'required',
            'password' => 'required',
            'cpassword' => 'required|same:password',
        ];
    }

//required_with:postal_code1

    public function messages()
    {
        return [
            'name.required' => 'الرجاء إدخال الإسم بالكامل',
            'user_name.required' => 'الرجاء إدخال إسم المستخدم ',
            'user_name.unique' => 'إسم المستخدم مسجل مسبقا',
            'email.required' => 'الرجاء إدخال البريد الإلكتروني',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقا',
            'email.email' => 'الرجاء إدخال الصيغد الصحيحد للبريد الإلكتروني',
            'mobile.required' => 'الرجاء إدخال رقم الهاتف',
            'password.required' => 'الرجاء إدخال كلمة المرور',
            'cpassword.required' => 'الرجاء إدخال تأكيد كلمة المرور',
            'cpassword.same' => 'تأكيد كلمد المرور يجب ان يكون مساوي لكلمة المرور',

        ];
    }
}
