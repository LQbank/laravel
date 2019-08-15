<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

use  App\Models\Users;

use Hash;

class homeuserRequest extends FormRequest
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
    public function rules(Request $request)
    {

        $passwd = $request->input('oldpasswd','');

        //查询登录的用户数据
        $user = Users::find(session('home_user')->id);
    
        // 验证原密码正确
   		// if (!Hash::check($passwd, $user->passwd)) {
        //     return back()->with('success', '原密码错误');
        // }

        //转换不了哈希值
        $values = $user->passwd;


        return [
            //不为纯数字或字母的正在表达式 用于密码验证
            // ^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$
           
            //判断原密码是否正确
            'oldpasswd' => 'required|digits:'.$values,
            'passwd' => 'required|regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',
            'repass' => 'required|same:passwd',
            
        ];
    }

    public function messages()
    {
        return [
            'oldpasswd.required'=>'原密码必填',    
        
            'passwd.required'=>'新密码必填',    
            'passwd.regex'=>'新密码格式错误',    
            'repass.required'=>'确认密码必填',    
            'repass.same'=>'俩次密码不一致',    
                
        ];
    }
}
