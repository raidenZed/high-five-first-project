<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class ChangePermissionUserRequest extends FormRequest
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
            'permission' => 'required|array|min:1|'.Rule::in(Permission::select('name')->get()->pluck("name")),

        ];

//        Rule::in(['first-zone', 'second-zone'])
    }

//required_with:postal_code1

    public function messages()
    {
        return [

            'id.required' => 'الرجاء إدخال رقم الملف بالكامل',
            'id.exists' => 'العنصر غير موجود بالنظام',
            'permission.required' => 'الرجاء تحديد صلاحية واحدة على الأقل',
            'permission.in' => 'الصلاحيات المدخلة غير موجودة بالنظام',

        ];
    }
}
