<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '请填写用户名',
            'name.unique' => '用户已存在',
            'email.required' => '请填写邮箱',
            'email.unique' => '邮箱已存在',
            'email.email' => '邮箱格式错误',
            'password.required' => '请填写密码',
            'password.min' => '密码最低为6个字符',
            'password.confirmed' => '密码和确认密码不一致',
        ];
    }
}
