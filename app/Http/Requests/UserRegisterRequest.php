<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6'
        ];
    }

    public function messages(){
        return[
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名长度需要大于3',
            'email.required'=>'用户邮箱不能为空',
            'email.unique'=>'此邮箱已经被注册',
            'email.email'=>'请填写正确的邮箱格式',
            'password.required'=>'用户密码不能为空',
            'password.min'=>'用户密码长度太短',
            'password.confirmed'=>'确认密码不一致',
            'password_confirmation.required'=>'确认密码不能为空',
        ];
    }
}
