<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
                'password'=>'required|min:6',
                'captcha'=>'required|captcha'
            ];
    }

    public function messages(){
        return[
            'email.required'=>'用户邮箱不能为空',
            'email.email'=>'请填写正确的邮箱格式',
            'password.required'=>'用户密码不能为空',
            'password.min'=>'用户密码长度太短',
            'captcha.required'=>'验证码不能为空'
        ];
    }
}
