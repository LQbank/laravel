<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class RolesController extends Controller
{
    public static function controllernames()
    {
        return [
            'userscontroller'=>'用户管理',
            'goodscontroller'=>'商品管理',
            'catescontroller'=>'分类管理',
            'rolescontroller'=>'角色管理',
            'nodescontroller'=>'权限管理',
            'adminusercontroller'=>'管理员管理',
        ];
    } 

    public static function node()
    {
        $node = DB::table('node')->get();
        $arr = [];
        $temp = [];
        foreach ($node as $key => $value) {
            $temp['id'] = $value->id;
            $temp['desc'] = $value->desc;
            $temp['aname'] = $value->aname;
            $arr[$value->cname][] = $temp;
        }
  
        return $arr;
    }

    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $nodes = self::node();
      
        $controllernames = self::controllernames();
       
        // 加载页面
        return view('admin.roles.create',['nodes'=>$nodes,'controllernames'=>$controllernames]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        // dd($request->input());

        $rname = $request->input('rname');
        $nid = $request->input('nid');
        $rid = DB::table('role')->insertGetId(['rname'=>$rname]);

        if($rid){
            foreach ($nid as $key => $value) {
               $res =  DB::table('role_node')->insert(['rid'=>$rid,'nid'=>$value]);
                if(!$res){
                    DB::rollBack();
                    return back()->with('error','添加失败');
                }
            }
            
        }

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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
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

     

        if($rid){

            if($nid ){
                 //遍历往role_node表  插入
                foreach ($nid as $key => $value) {
                    $res =  DB::table('role_node')->insert(['rid'=>$rid,'nid'=>$value]);
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
