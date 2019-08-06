<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;

class CatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 获取所有的分类
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCates()
    {
        // $cates = Cates::all();
        $cates = DB::select("select *,concat(path,',',id) as paths from cates order by paths asc");

        foreach ($cates as $key => $value) {
            // 统计，出现次数
            $n = substr_count($value->path,',');
            // 重复使用字符串
            $cates[$key]->cname = str_repeat("|-----",$n).$value->cname;
        }
        return $cates;
    }


    /**
     * 查看分类页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 加载模板
        return view('admin.cates.index',['cates'=>self::getCates()]);
    }

    /**
     * Display a listing of the resource.
     *
     * 改变商品分类是否上架
     *
     * @return \Illuminate\Http\Response
     */
    public function changestatus(Request $request)
    {
        // 修改商品分类是否上架
        DB::table('cates')->where('id',$request->input('cid'))->update(['status' => $request->input('status')]);
    }

    /**
     * 加载分类添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 获取传参的id
        $id = $request->input('id',0);

        // 加载添加视图
        return view('admin.cates.create',['id'=>$id,'cates'=>self::getCates()]);
    }

    /**
     * 执行添加分类
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取pid
        $pid = $request->input('pid');

        // 判断是否为父分类
        if($pid == 0){
            $path = 0;
        }else{
            // 获取父级的数据
           $parent_data = Cates::find($pid);
           $path = $parent_data->path.','.$parent_data->id;
        }

        // 添加
        $cate = new Cates;
        $cate->cname = $request->input('cname','');
        $cate->pid = $pid;
        $cate->path = $path;

        // 判断分类添加是否成功
        if($cate->save()){
            return redirect('admin/cates')->with('success','添加成功');
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
