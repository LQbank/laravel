<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Contracts\Validation\Validator;

class HoemusersStore extends FormRequest
{
    protected  $errorBag  =  'email';
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
        // dd(request()->user()->id);
        // dd(request::all());
        return [
            'email' => 'required|email|unique:users', 
   
            'passwd' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:passwd',
        ];
    }


    public function messages()
    {
        return [   
            'email.required'=>'邮箱必填',   
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'email已经注册',    
            'passwd.required'=>'密码必填',    
            'passwd.regex'=>'密码格式错误',    
            'repass.required'=>'确认密码必填',    
            'repass.same'=>'俩次密码不一致',    

        ];
        
    }


    //重写父类
    // protected function failedValidation(Validator $validator)
    // {

       

    //     $this->errorBag  =  'create';


    //     // dump($project);


    //     parent::failedValidation($validator);
    // }
}
