<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordEditRequest extends FormRequest
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
            'old_password'=>'required',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6'
        ];
    }

    public function messages(){
        return[
            'old_password.required'=>'原密码不能为空',
            'password.min'=>'用户密码长度太短',
            'password.confirmed'=>'确认密码不一致',
            'password_confirmation.required'=>'确认密码不能为空',
            'password_confirmation.min'=>'确认密码不一致'
        ];
    }
}
