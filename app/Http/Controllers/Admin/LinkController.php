<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\links;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载 模板
        return view('admin.link.create'); 
    }

    /**
     * Store a newly created resource in storage.
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
     * Remove the specified resource from storage.
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
    
        // 判断
        if($res1){
           
            // 删除图片
            $res2 = Storage::delete([$path]);

            return redirect('admin/link')->with('success', '删除成功');
        }else{
           
            return back()->with('error', '删除失败');
        }
    }

    public function  changeStatus(Request $request){


        // echo  $request->input('id');

        $mod = new links;
        
        $res = $mod->find( $request->input('id'));
        
        // dump($res);
        $res->status =  $res->status  ? '0' : '1';
            
        $save = $res->save();
        
        if($save){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
}
