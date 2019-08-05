<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoemphoneStore extends FormRequest
{
    protected  $errorBag  =  'phone';
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
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'code' => 'required',
            'passwd' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:passwd',
        ];
    }
    public function messages()
    {
        return [   
            
            'phone.required'=>'手机号必填',    
            'phone.regex'=>'手机号格式错误',
            'code.required'=>'验证码必填',
            'passwd.required'=>'密码必填',    
            'passwd.regex'=>'密码格式错误',    
            'repass.required'=>'确认密码必填',    
            'repass.same'=>'俩次密码不一致',   
        ];
    }
}
 
