<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class NodesController extends Controller
{
    /**
     * 查看权限显示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 查出所有的权限
        $data = DB::table('node')->get();
        // 显示数据
        return view('admin.nodes.index',['data'=>$data]);
    }

    /**
     * 加载添加权限页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载模板
        return view('admin.nodes.create');
       
    }

    /**
     * 执行添加权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // dump($request->all());
        // 获取数据
        $data = $request->except('_token');

        // 加上控制器名
        $data['cname'] = $data['cname'].'controller';

        // 添加权限
        $res = DB::table('node')->insert($data);

        // 判断添加权限是否成功
        if($res){
            return redirect('admin/nodes')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
