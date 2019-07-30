<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminsStore extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z]{1}[\w]{7,15}$/|unique:users',
            'passwd' => 'required|regex:/^[\w]{6,18}$/',
            'spass' => 'required|same:passwd',
        ];
    }


    public function messages()
    {
        return [
            'name.required'=>'管理员账号必填',    
            'name.regex'=>'管理员账号格式错误',    
            'name.unique'=>'管理员账号已存在',    
            'passwd.required'=>'管理员密码必填',    
            'passwd.regex'=>'管理员密码格式错误',    
            'spass.required'=>'确认密码必填',    
            'spass.same'=>'俩次密码不一致',  
        ];
    }
}
