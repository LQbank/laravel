<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cartoons;
use Illuminate\Support\Facades\Storage;

class CartoonController extends Controller
{
    /**
     * 轮播图查看页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取所有轮播图数据
        $Cartoons = Cartoons::get();

        // dd($Cartoons);
        
        //加载 模板
        return view('admin.cartoon.index',['Cartoons'=>$Cartoons]); 
    }

    /**
     * 加载添加轮播图页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //加载 模板
          return view('admin.cartoon.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * 完成上传图片并添加
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
         $user = new Cartoons;
         $user->name = $request->input('name','');
         $user->pic = $path;
        
         // 保存
         $res1 = $user->save();

         // 判断是否成功
         if($res1){
             return redirect('admin/cartoon')->with('success', '添加成功');
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
     * 删除轮播图
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 获取轮播图图片
        $userinfo = Cartoons::where('id',$id)->first();

        $path = $userinfo->pic;

        // 删除轮播图
        $res1 = Cartoons::destroy($id);
    
        // 判断是你出轮播图是否成功
        if($res1){
            // 删除上传的图片
            $res2 = Storage::delete([$path]);

            return redirect('admin/cartoon')->with('success', '删除成功');
        }else{
           
            return back()->with('error', '删除失败');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * 更改轮播图的状态
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function  changeStatus(Request $request)
    {
        $mod = new Cartoons;
        
        // 拿出当前的数据
        $res = $mod->find( $request->input('id'));
        
        // 把状态取反
        $res->status =  $res->status  ? '0' : '1';
        
        // 保存
        $save = $res->save();
        
        // 判断是否成功
        if($save){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
}
