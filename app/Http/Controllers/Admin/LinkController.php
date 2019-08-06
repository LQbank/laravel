<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\links;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * 轮播图的显示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取 数据
        $links = links::get();

        //加载 模板
        return view('admin.link.index',['links'=>$links]); 
    }

    /**
     * 添加轮播图的页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载 模板
        return view('admin.link.create'); 
    }

    /**
     * 执行轮播图添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 检查文件上传
        if ($request->hasFile('pic')) {
            // 获取头像
            $path = $request->file('pic')->store(date('Ymd'));
        }else{
            return back();
        }
        
       
         // 实例化模型
         $user = new links;
         $user->link = $request->input('link','');
         $user->pic = $path;
        

         $res1 = $user->save();
         if($res1){
             return redirect('admin/link')->with('success', '添加成功');
         }else{
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
     * 执行轮播图的删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 获取友情链接图片
        $userinfo = links::where('id',$id)->first();
        $path = $userinfo->pic;

        // 删除主用户
        $res1 = links::destroy($id);
    
        // 判断删除是否成功
        if($res1){
           
            // 删除图片
            $res2 = Storage::delete([$path]);

            return redirect('admin/link')->with('success', '删除成功');
        }else{
           
            return back()->with('error', '删除失败');
        }
    }

    /**
     * 改变轮播图的状态
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  changeStatus(Request $request)
    {
        $mod = new links;
        
        // 查出当前轮播图数据
        $res = $mod->find( $request->input('id'));
        
        // 把轮播图状态取反
        $res->status =  $res->status  ? '0' : '1';
            
        // 执行修改
        $save = $res->save();
        
        // 判断是否成功
        if($save){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
}
