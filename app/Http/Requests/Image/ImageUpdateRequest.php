<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
            'status' => 'required',
            'sort' => 'integer',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'status.required' => '状态为必填项',
            'sort.integer' => '序号必须为整数',
        ];
    }
}
