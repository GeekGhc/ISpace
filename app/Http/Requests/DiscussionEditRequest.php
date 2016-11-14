<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscussionEditRequest extends FormRequest
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
            'title'=>'required',
            'body'=>'required',
        ];
    }

    public function messages(){
        return[
            'title.required'=>'帖子标题不能为空',
            'body.required'=>'帖子正文内容不能为空',
        ];
    }
}
