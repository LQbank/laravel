<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminsStore;
use App\Models\Adminusers;
use Hash;
use DB;

class AdminuserController extends Controller
{
    /**
     * 查看所有后台用户
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查看所有用户
        $adminusers = DB::table('admin_user')->get();
 
        // 加载表单
        return view('admin.adminuser.index',['adminusers'=>$adminusers]);
    }

    /**
     * 加载添加用户页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //查询所有用户
         $role = DB::table('role')->get();
        //  dd($role);
 
        // 加载表单
        return view('admin.adminuser.create',['role'=>$role]);
    }

    /**
     * 执行添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminsStore $request)
    // public function store(Request $request)
    {
        // dd($request->input());
        // 开启事务
        DB::beginTransaction();
        
        // 检查文件上传
        if ($request->hasFile('profile')) {
            // 获取头像
            $path = $request->file('profile')->store(date('Ymd'));
        }

        // 实例化模型
        $user = new Adminusers;
        $user->name = $request->input('name','');
        $user->passwd = Hash::make($request->input('passwd',''));

        //判断是否上传头像
        if (isset($path)) {
            $user->profile = $path;
        }
        
        // 保存
        $res1 = $user->save();

        $rid =  $request->input('rid','');

        $uid = $user->id;

        $role = DB::table('user_role')->insert(['uid' => $uid, 'rid' => $rid]);
       


        // 判断是否成功
        if($res1 && $role){
            DB::commit();
            return redirect('admin/adminuser')->with('success', '添加成功');
        }else{
            DB::rollBack();
            return back()->with('error', '添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 加载修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查看所有权限
        $roles = DB::table('role')->get();

        //查看已有权限
        $user_role = DB::table('user_role')->where('uid',$id)->get();

        $array = [];
        
        // 把已有权限遍历压入数组
        foreach($user_role as $v){
            array_push($array,$v->rid);
        }

        $roles = $roles->all();

        return view('admin.adminuser.edit',['roles'=>$roles,'id'=>$id,'quan'=>$array]);
    }

    /**
     * 执行用户修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 开启事务
        DB::beginTransaction();

        //获取 页面提交 数据
        $role_id = $request->input('role');
        // dd($role_id);
       
        //查看当前角色
        $role = DB::table('user_role')->where('uid',$id)->get();
        // dd(gettype($id));
        
        
        // 如果不为空  把所有的角色都删除
        if(!empty($role)){
            $role = DB::table('user_role')->where('uid',$id)->delete();
        }
        
        // 判断页面是否提交数据
        if($role_id){
            // 把提交的数据遍历添加到角色中
            foreach($role_id as $v){
                // 添加角色
                $res = DB::insert('insert into user_role (uid, rid) values (?, ?)', [$id,$v]);

                // 判断添加角色是否成功
                if(!$res){
                    DB::rollBack();
                    return back()->with('error','修改失败');
                }
            
            }
        }

        DB::commit();
        
        return redirect("admin/adminuser")->with('success', '修改成功');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
