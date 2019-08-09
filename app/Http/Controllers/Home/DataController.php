<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\Users;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function index()
    {

        // dd(explode(',', session('home_user')->birthday));
        return view('home/data/index');
    }

    public function changedata(Request $request)
    {

        // dd($request->input());
        $id= session('home_user')->id;

        
        // 查出当前数据
        $user = Users::where('id',$id)->first();

        // 准备添加的参数
        $user->nickname = $request->input('nickname','');
        $user->name = $request->input('name','');
        
        //性别
        switch($request->input('radio',''))
        {
            case 'boy':
                $user->sex ='1';
            break;  
            case 'girl':
                $user->sex ='0';
            break;
            default:
                $user->sex ='2';
        }

        //生日
        $user->birthday = $request->input('birthday','');

        //判断email是否存在
        if($request->input('email','')){
            $user->email = $request->input('email','');
        }
        //判断phone是否存在
        if($request->input('phone','')){
            $user->phone = $request->input('phone','');
        }
        
       

        // 修改
        $res1 = $user->save();

        // dd($res1);

        // 判断是否成功
        if($res1){
            //修改当前页面session
            $user = Users::where('id',$id)->first();

            session(['home_user'=>$user]);


            return redirect('admin/users')->with('success', '修改');
        }else{
            return back()->with('error', '修改失败');
        }


    }

    public function avatar(Request $request)
    {
        // dump($request->input());
        // dump($request->file());

        $id = $request->input('id','');

        // 检查文件上传
        if ($request->hasFile('avatar')) {
            // 获取头像
            $path = $request->file('avatar')->store(date('Ymd'));
            


            // 查出当前数据
            $usersinfo = Users::where('id',$id)->first();

            // 删除图片
            Storage::delete([$usersinfo->avatar]);
 
            //连接表修改
            $user = Users::find($id);
            $user->avatar = $path;
            $res1 = $user->save();

           
            //判断是否成功
            if($res1){
                //修改session图片
                session('home_user')->avatar=$path;

               echo $path;
            }


        }else{
            
        }

       
    }
}
