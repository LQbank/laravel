<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
    /**
     * 中文分词需要的文件引入
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // 引入类文件
        require '/pscws4/pscws4.class.php';
        // 实例化
        @$this->cws = new \PSCWS4;
        //设置字符集
        $this->cws->set_charset('utf8');
        //设置词典
        $this->cws->set_dict('pscws4/etc/dict.utf8.xdb');
        //设置utf8规则
        $this->cws->set_rule('pscws4/etc/rules.utf8.ini');
        //忽略标点符号
        $this->cws->set_ignore(true);
    }

    /**
     * 拿出所有的商品名称
     *
     * @return \Illuminate\Http\Response
     */
    public function dataWord()
    {
        // 获取所有未进行中文分词的商品
        $data = DB::table('good')->select('name','id')->where('word_status',0)->get();

        // 把所有的商品都进行中文分词的状态
        DB::table('good')->update(['word_status'=>1]);

        // 遍历未进行中文分词的商品
        foreach($data as $key=>$value){
            // 调用函数进行中文分词的分割
            $arr = $this->word($value->name);
            // if(count($arr) > 0){
                // 遍历插入中文分词表中
                foreach($arr as $kk=>$vv){
                    DB::table('good_word')->insert(['word'=>$vv,'gid'=>$value->id]);
                    
                }
            // }
            
            // dump($arr);
        }
        // dump($arr);
    }

    /**
     * 中文分词的引入
     *
     * @return \Illuminate\Http\Response
     */
    public function word($text)
    {
        //声明字符串
        // $text = '美军5架全球鹰无人侦察机将暂时部署日本EOF';
        // 把参数用空格分隔开
        $arr = explode(' ',$text);

        // 检查格式的正则表达式
        $preg = '/[\w\+\%\.\(\)]+/';

        $string = '';

        // 把分割后的参数遍历并用正则替换
        foreach($arr as $key => $value){
            $string .= preg_replace($preg,'',$value);
        }

        // dd($string);
        
        //传递字符串
        $this->cws->send_text($string);
        //获取权重最高的前十个词
        // $res = $cws->get_tops(10);// top 顶部

        //获取所有的结果
        $res = $this->cws->get_result();
        // dd($res);
        $list = [];
        
        // 判断中文分词是否成功 成功遍历压入数组中
        if($res){
            foreach($res as $key=>$value){
                $list[] = $value['word'];
            }
        }

        
        // dd($list);

        return $list;
        //打印
        // var_dump($res);
        


    }

    /**
     * 关闭中文分词
     *
     * @return \Illuminate\Http\Response
     */
    public function __destruct()
    {
        //关闭
        $this->cws->close();
    }

    /**
     * 搜索后显示的页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 调用中文分词方法 把关键字插入数据库
        $this->dataWord();
        // $str = '倍混合 变焦麒麟 980芯片 屏内 指纹';
        // $this->word($request->all()['search']);

        // 搜索的关键字
        $search = $request->input('search','');

        // 判断关键字是否为空
        if(!empty($search)){
            // 正则匹配是否有 数字字母下划线
            if(preg_match('/[\w]/',$search)){
                // 查询数据库商品表
                $data2 = DB::table('good')->where('name','like','%'.$search.'%')->join('sku','sku.good_id','good.id')->get();
            }else{
                // 查询数据库商品关键字表
                $gid = DB::table('good_word')->select('gid')->where('word',$search)->get();
                // dump($gid);
                // dd(count($gid));
                // 判断关键字是否存在
                if(count($gid) > 0){
                    // 把gid字段压入一个数组中
                    foreach($gid as $key=>$value){
                        $gids[] = $value->gid;
                    }
                    // dd($gids);

                    // 去掉重复的值
                    $gidss = array_unique($gids);

                    // 查询出所有的想要的商品
                    $data2 = DB::table('good')->whereIn('good.id',$gidss)->join('sku','sku.good_id','good.id')->get();
                }else{
                    // 查询数据库商品表
                    $data2 = DB::table('good')->where('name','like','%'.$search.'%')->join('sku','sku.good_id','good.id')->get();
                }
            }


            

            
            // dump($data2);
        }else{
            // 查询所有的商品
            $data2 = DB::table('good')->join('sku','sku.good_id','good.id')->get();
        }

        
        // dd($data2);
        return view('home.search.index',['data'=>$data2]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
