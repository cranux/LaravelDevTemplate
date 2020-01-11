<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'password' => 'sometimes|confirmed',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => '请填写密码',
            'password.min' => '密码最低为6个字符',
            'password.confirmed' => '密码和确认密码不一致',
        ];
    }
}
