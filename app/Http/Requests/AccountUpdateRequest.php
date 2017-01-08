<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
        $id = \Auth::user()->id;
        return [
            'name'=>'required|min:3|unique:users,name,'.$id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名长度需要大于3',
            'name.unique'=>'用户名已经被占用',
        ];
    }
}
