<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersStore;
use App\Models\Users;
use App\Models\Usersinfo;
use Hash;
use DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * 后台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 拿出查询用户参数
        $search = $request->input('search','');

        // 获取当前用户数据
        $users = Users::where('name','like','%'.$search.'%')->paginate(2);

        // 判断用户是否存在
        if(!empty($users)){
            $users = Users::paginate(2);
            
        }

        // 加载模板
        return view('admin.users.index',['users'=>$users,'requests'=>$request->input()]);  
    }

    /**
     * 显示 添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示页面
        return view('admin.users.create');
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersStore $request)
    {
        
        // 检查文件上传
        if ($request->hasFile('avatar')) {
            // 获取头像
            $path = $request->file('avatar')->store(date('Ymd'));
        }else{
            return back();
        }
        
        // 实例化模型
        $user = new Users;

        // 准备添加的参数
        $user->name = $request->input('name','');
        $user->passwd = Hash::make($request->input('passwd',''));
        $user->email = $request->input('email','');
        $user->phone = $request->input('phone','');
        $user->avatar = $path;

        // 添加
        $res1 = $user->save();

        // 判断是否成功
        if($res1){
            return redirect('admin/users')->with('success', '添加成功');
        }else{
            return back()->with('error', '添加失败');
        }
    }

    /**
     * 显示详情页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查出当前修改的数据
        $user = Users::find($id);

        // 加载视图
        return view('admin.users.edit',['user'=>$user]);
        
    }

    /**
     * 执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        // 检查用户是否有文件上传
        if(!$request->hasFile('avatar')){
            // 查出要修改的数据
            $user = Users::find($id);

            // 修改数据字段
            $user->email = $request->input('email','');
            $user->phone = $request->input('phone','');

            // 保存并判断是否成功
            if($user->save()){
                return redirect('admin/users')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }

        }else{
            // 接收文件上传
            $path  = $request->file('avatar')->store(date('Ymd'));

            // 查出当前数据
            $usersinfo = Users::where('id',$id)->first();

            // 删除图片
            Storage::delete([$usersinfo->avatar]);

            // 修改用户的主信息
            $user = Users::find($id);
            $user->email = $request->input('email','');
            $user->phone = $request->input('phone','');
            $user->avatar = $path;

            // 保存
            $res = $user->save();

            // 判断是否成功
            if($res){
                return redirect('admin/users')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }
        }
    }

    /**
     * 删除用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 获取用户头像
        $userinfo = Users::where('id',$id)->first();

        $path = $userinfo->avatar;
        
        // 删除主用户
        $res1 = Users::destroy($id);
    
        // 判断用户删除是否成功
        if($res1){
           
            // 删除图片
            $res2 = Storage::delete([$path]);
           
            return redirect('admin/users')->with('success', '删除成功');
        }else{
           
            return back()->with('error', '删除失败');
        }
        
    }
}
