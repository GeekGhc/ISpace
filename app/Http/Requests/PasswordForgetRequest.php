<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordForgetRequest extends FormRequest
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
            'email'=>'required|email',
            'captcha'=>'required|captcha'
        ];
    }

    public function messages(){
        return[
//            'email.unique'=>'注册邮箱不存在',
            'email.required'=>'注册邮箱不能为空',
            'email.email'=>'请填写正确的邮箱格式',
        ];
    }
}
