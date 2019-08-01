<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;
use Cache;

class GoodsController extends Controller
{
    // 
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 查出所有的分类并排版
     *
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
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 查出当前分类下所有的sku
     *
     */
    public function getTagAndVals(Request $request){
        // dump($request->all());
        // 拿出传递过来的参数cate_id
        $cate_id = $request->all()['cate_id'];
       
        // 查出cate_id的数据库数据
        // $pid = explode(',',DB::table('cates')->find($cate_id)->path)[1];
        // dump($pid);
        // // 判断是否存在
        if(!$pid = explode(',',DB::table('cates')->find($cate_id)->path)[1]){
            $pid = $cate_id;
        }

        // 查出所有当前商品的标签名称
        $tags = DB::table('tag')->where('cate_id',$pid)->get();

        // 把所有的标签属性放到标签名称的数组中
        foreach($tags as &$tag){
            $vals = DB::table('val')->where('tag_id',$tag->id)->get();
          
            $tag->vals = $vals;
        }

        echo json_encode($tags);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 上传商品的图片
     *
     */
    public function picUpload(Request $request)
    {
        $path = $request->file('pic')->store(date('Ymd'));
        echo $path;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 写入商品
     *
     */
    public function insert(Request $request)
    {
        DB::beginTransaction();
        // dump(Cache::get('skus'));
        // dd($request->all());
        // dump($request->input('name'));

        
        // $mod = D('Good');
        // $gid = $mod->create();
        $array = [];

        $array['cate_id'] = $request->input('cate_id');
        $array['name'] = $request->input('name');
        $array['company'] = $request->input('company');
        $array['desc'] = $request->input('editorValue');
        $array['time'] = time();


        // 插入tag表并返回id
        $Id = DB::table('good')->insertGetId($array);
        // dd($Id);
        
        $status = $this->add_sku($Id);

        if($Id && $status){
            DB::commit();
            return redirect('admin/goods')->with('success', '添加成功');
        }else{
            DB::rollBack();
            return back()->with('error', '添加失败');
        }
    }

    // 添加商品的sku
    public function add_sku($Id){
        $flag = true;
        // $mod = M('sku');
        // sleep(0.1);

        foreach(Cache::get('skus') as $sku){
            $data['good_id'] = $Id;
            $data['sku'] = $sku['sku'];
            $data['price'] = $sku['price'];
            $data['num'] = $sku['num'];
            $data['pic'] = $sku['pic'];
            $data['status'] = 1;
            
            $res = DB::table('sku')->insertGetId($data);

            if(!$res){
                $flag = false;
            }
        }

        // 移除缓存
        Cache::forget('skus');
        // dump($flag);

        return $flag;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 写入商品具体的数据
     *
     */
    public function addsku(Request $request)
    {
        // S('skus',$request->all()['skus']);
        Cache::forever('skus', $request->all()['skus']);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 改变商品的状态
     *
     */
    public function changestatus(Request $request)
    {
        // dump($request->input('gid'));
        // dump($request->input('status'));
        DB::table('good')->where('id',$request->input('gid'))->update(['status' => $request->input('status')]);

    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 删除商品 并删除该商品的sku
     *
     */
    public function del(Request $request,$id)
    {
        // 开启事务
        DB::beginTransaction();

        // 删除good表中的商品
        $res = DB::table('good')->where('id',$id)->delete();

        // 删除sku表中的商品关联sku
        $res2 = DB::table('sku')->where('good_id',$id)->delete();

        // 判断是否删除成功
        if($res && $res2){
            // 提交事务
            DB::commit();
            return back();
        }else{
            // 回滚事务
            DB::rollBack();
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 查看商品具体的sku
     *
     */
    public function indexsku(Request $request,$id,$name)
    {
        $res = DB::table('sku')->where('good_id',$id)->get();

        return view('admin/goods/indexsku',['res'=>$res,'name'=>$name,'id'=>$id]);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 更改sku的状态
     *
     */
    public function changeskustatus(Request $request,$id,$name,$status,$gid)
    {

        if($status == '1'){
            $status = 0;
        }else{
            $status = 1;
        }

        DB::table('sku')->where('id',$id)->update(['status' => $status]);

        
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mod = M('good');
        // $goods = $mod
        // ->field('good.*,cate.name as c_name,sku.pic')
        // ->join('left join sku on sku.good_id=good.id')
        // ->join('cate on cate.id=good.cate_id')
        // ->group('good.id')
        // ->select();
        $goods = DB::table('good')
                    ->select('good.*','cates.cname as c_name','sku.pic','sku.id as sid')
                    ->leftJoin('sku','sku.good_id','=','good.id')
                    ->leftJoin('cates','cates.id','good.cate_id')
                    ->groupBy('good.id')
                    ->get();
        // dd($goods);

        // $this->assign('goods',$goods);
        // $this->display();

        return view('admin.goods.index',['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 调用getCates方法获取所有的分类并返回页面
        return view('admin.goods.create',['cates'=>self::getCates()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
