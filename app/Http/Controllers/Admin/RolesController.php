<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class RolesController extends Controller
{
    /**
     * 返回所有的控制权限大类别
     *
     * @return \Illuminate\Http\Response
     */
    public static function controllernames()
    {
        return [
            'userscontroller'=>'用户管理',
            'goodscontroller'=>'商品管理',
            'catescontroller'=>'分类管理',
            'rolescontroller'=>'角色管理',
            'nodescontroller'=>'权限管理',
            'adminusercontroller'=>'管理员管理',
            'cartooncontroller'=>'轮播图管理',
            'linkcontroller'=>'友情链接管理',
            'ordercontroller'=>'订单管理',

        ];
    } 

    /**
     * 查看所有的权限
     *
     * @return \Illuminate\Http\Response
     */
    public static function node()
    {
        // 查看所有权限
        $node = DB::table('node')->get();
        $arr = [];
        $temp = [];

        // 遍历权限并压入数组中
        foreach ($node as $key => $value) {
            // 压入数组中的数据
            $temp['id'] = $value->id;
            $temp['desc'] = $value->desc;
            $temp['aname'] = $value->aname;

            // 压入数组
            $arr[$value->cname][] = $temp;
        }
  
        return $arr;
    }

    /**
     * 显示角色页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('role')->get();
        // 显示遍历
        return view('admin.roles.index',['data'=>$data]);
    }

    /**
     * 加载添加角色的页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查出所有权限
        $nodes = self::node();
      
        // 查出所有的权限大分类
        $controllernames = self::controllernames();
       

        // dd($nodes);
        // 加载页面
        return view('admin.roles.create',['nodes'=>$nodes,'controllernames'=>$controllernames]);
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 开启事务
        DB::beginTransaction();

        // dd($request->input());

        // 添加的数据
        $rname = $request->input('rname');
        $nid = $request->input('nid');

        // 执行添加并返回id
        $rid = DB::table('role')->insertGetId(['rname'=>$rname]);

        // 判断添加是否成功
        if($rid){
            // 遍历传过来的所有权限的id
            foreach ($nid as $key => $value) {
                // 关联角色和权限
                $res =  DB::table('role_node')->insert(['rid'=>$rid,'nid'=>$value]);

                // 判断是否关联成功
                if(!$res){
                    // 回滚事务
                    DB::rollBack();
                    return back()->with('error','添加失败');
                }
            }
            
        }

        // 提交事务
        DB::commit();
        return redirect('admin/roles')->with('success','添加成功');

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
     * 加载修改角色权限的页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询 角色权限分支
        $nodes = self::node();

        //查询 角色名
        $role = DB::table('role')->find($id);
        
        //查询 角色 的权限id
        $role_node = DB::table('role_node')->where('rid',$id)->pluck('nid');

        //权限 总名称 数据
        $controllernames = self::controllernames();

        // dump($nodes);
        // dump($role_node);
        // dump($role);
        // dump($controllernames);
        
        // 加载视图
        return view('admin.roles.edit',['role'=>$role,'nodes'=>$nodes,'controllernames'=>$controllernames,'role_node'=>$role_node]);
    }

    /**
     * 修改角色权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        // dd($id);
        // dd($request->input());

        

        // dd($nid);
        //找到  rode表id
        $rid = $id;

        // dd($request->input('nid'));

        //先将role_node表rid 之前  权限清空
        $role = DB::table('role_node')->where('rid',$rid)->delete();

        //获取 提交的数组
        $nid = $request->input('nid');

     
        // 判断role 的id是否存在
        if($rid){

            if($nid ){
                 //遍历往role_node表  插入
                foreach ($nid as $key => $value) {
                    // 关联角色与权限
                    $res =  DB::table('role_node')->insert(['rid'=>$rid,'nid'=>$value]);

                    // 判断是否关联成功
                    if(!$res){
                        DB::rollBack();
                        return back()->with('error','修改失败');
                    }
                }
            }

        }

        DB::commit();
        return redirect('admin/roles')->with('success','修改成功');
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
