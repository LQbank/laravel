<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use APP\Models\Usersinfo;
use Hash;
use Mail;

class RegisterController extends Controller
{
    //
    public function index()
    {
    	// 加载模板
    	return view('home.register.index');
    }

    public function store(Request $request)
    {

    	$this->validate($request, [
	        'email' => 'required|email',
	        'upass' => 'required|regex:/^[\w]{6,18}$/',
	        'repass' => 'required|same:upass',
	    ],[
	    	'email.required'=>'邮箱必填',    
            'email.email'=>'邮箱格式错误',
	    	'upass.required'=>'密码必填',    
            'upass.regex'=>'密码格式错误',    
            'repass.required'=>'确认密码必填',    
            'repass.same'=>'俩次密码不一致', 
	    ]);
    	if ($request->input('upass') != $request->input('repass')) {
    		echo "<script>alert('两次密码不一致');location.href='/home/register';</script>";
    		exit;
    	}
    	// 注册
    	$users=new Users;
    	$users->email = $request->input('email','');
    	$users->passwd = Hash::make($request->input('upass',''));
    	$users->token = str_random(30);
    	$users->avatar = '20190727/DFl323SLCZq4QyXzt95SSE63L02nl4TuZCq59RIs.jpeg';

    	if ($users->save()) {
    		// 发送邮件 
    		Mail::send('home.email.email',['id'=>$users->id,'token'=>$users->token],function ($m) use ($users) {
    			$m->to($users->email)->subject('[lamp软件学院]注册激活邮件！');
    		});
    		echo "添加成功";
    	}else{
    		echo "<script>alert('添加失败');location.href='/home/register'</script>";
    	}
    }

    // 激活
    public function changeStatus(Request $request)
    {
    	$id = $request->input('id',0);
    	$token = $request->input('token',0);

    	$user = Users::find($id);

    	if ($user->token != $token) {
    		dd('链接失效');
    	}
    	$user->status = '1';
    	$user->token = str_random(30);
    	if($user->save()){
    		echo "激活成功";
    	}else{
    		echo "<script>alert('激活失败');location.href='/home/register'</script>";
    	}
    }

    // 手机号注册
    public function insert(Request $request)
    {
    	$this->validate($request, [
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'code' => 'required',
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
        ],[
            'phone.required'=>'手机号必填',    
            'phone.regex'=>'手机号格式错误',
            'code.required'=>'验证码必填',
            'upass.required'=>'密码必填',    
            'upass.regex'=>'密码格式错误',    
            'repass.required'=>'确认密码必填',    
            'repass.same'=>'俩次密码不一致', 
        ]);

    	// 验证手机的验证码
    	$phone=$request->input('phone',0);

    	// 获取发送到手机上验证码
    	$key = $phone.'_code';

    	$phone_code = session($key);

    	$code = $request->input('code',0);

    	if ($phone_code != $code) {
    		
    		echo "<script>alert('验证码错误');location.href='/home/register'</script>";
    		exit;
    	}
    	if ($request->input('upass') != $request->input('repass')) {
    		echo "<script>alert('两次密码不一致');location.href='home/register';</script>";
    		exit;
    	}
    	// 接受数据

    	// 压入到数据库
    	$users=new Users;
    	$users->phone = $request->input('phone','');
    	$users->passwd = Hash::make($request->input('upass',''));
    	$users->token = str_random(30);
    	$users->avatar = '20190727/DFl323SLCZq4QyXzt95SSE63L02nl4TuZCq59RIs.jpeg';
        if ($users->save()) {
            echo "添加成功";
        }else{
            echo "<script>alert('添加失败');location.href='/home/register'</script>";
        }
    }

    // 发送手机号 验证码
    public function sendPhone(Request $request)
    {
    	// 接收手机号
    	$phone=$request->input('phone');
    	$code=rand(1234,4321);
    	//如果存入redis中 注意键名覆盖
    	$key = $phone.'_code';

    	session([$key=>$code]);
    	// exit;
    	$url = "http://v.juhe.cn/sms/send";
		$params = array(
		    'key'   => '0be5c345c06fc3b113c6ffe870b37598', //您申请的APPKEY
		    'mobile'    => $phone, //接受短信的用户手机号码
		    'tpl_id'    => '176472', //您申请的短信模板ID，根据实际情况修改
		    'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
		    'dtype'=>'json'
		);

		$paramstring = http_build_query($params);
		$content = self::juheCurl($url, $paramstring);
		// echo $content;
    }


    /**
	 * 请求接口返回内容
	 * @param  string $url [请求的URL地址]
	 * @param  string $params [请求的参数]
	 * @param  int $ipost [是否采用POST形式]
	 * @return  string
	 */
	public static function juheCurl($url, $params = false, $ispost = 0)
	{
	    $httpInfo = array();
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    if ($ispost) {
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	        curl_setopt($ch, CURLOPT_URL, $url);
	    } else {
	        if ($params) {
	            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
	        } else {
	            curl_setopt($ch, CURLOPT_URL, $url);
	        }
	    }
	    $response = curl_exec($ch);
	    if ($response === FALSE) {
	        //echo "cURL Error: " . curl_error($ch);
	        return false;
	    }
	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
	    curl_close($ch);
	    return $response;
	} 
}
